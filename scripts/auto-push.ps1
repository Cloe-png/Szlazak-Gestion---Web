param(
    [int]$DebounceSeconds = 5
)

$repoPath = (Resolve-Path "$PSScriptRoot\..")
Set-Location $repoPath

$ignorePatterns = @(
    '\\.git\\',
    '\\node_modules\\',
    '\\vendor\\',
    '\\storage\\',
    '\\bootstrap\\cache\\'
)

function Should-IgnorePath([string]$path) {
    foreach ($pattern in $ignorePatterns) {
        if ($path -match $pattern) {
            return $true
        }
    }
    return $false
}

function Do-Push {
    $status = git status --porcelain
    if (-not $status) { return }

    git add -A | Out-Null
    $timestamp = Get-Date -Format "yyyy-MM-dd HH:mm:ss"
    git commit -m "Auto update $timestamp" --no-gpg-sign | Out-Null
    git push | Out-Null
}

$fsw = New-Object System.IO.FileSystemWatcher $repoPath, "*"
$fsw.IncludeSubdirectories = $true
$fsw.EnableRaisingEvents = $true
$fsw.NotifyFilter = [IO.NotifyFilters]'FileName, DirectoryName, LastWrite'

$script:pending = $false
$script:lastEvent = Get-Date

$handler = {
    if (Should-IgnorePath $Event.SourceEventArgs.FullPath) { return }
    $script:pending = $true
    $script:lastEvent = Get-Date
}

Register-ObjectEvent $fsw Changed -Action $handler | Out-Null
Register-ObjectEvent $fsw Created -Action $handler | Out-Null
Register-ObjectEvent $fsw Deleted -Action $handler | Out-Null
Register-ObjectEvent $fsw Renamed -Action $handler | Out-Null

Write-Host "Auto-push running for $repoPath. Ctrl+C to stop."

while ($true) {
    if ($script:pending) {
        $elapsed = (Get-Date) - $script:lastEvent
        if ($elapsed.TotalSeconds -ge $DebounceSeconds) {
            $script:pending = $false
            Do-Push
        }
    }
    Start-Sleep -Seconds 1
}
