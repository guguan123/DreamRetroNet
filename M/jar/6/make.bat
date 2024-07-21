rmdir .\JBProject\src /S/Q
rmdir .\JBProject\res /S/Q
mkdir .\JBProject\src
mkdir .\JBProject\res

rem xcopy .\res .\JBProject\res\ /S
mkdir .\JBProject\res\music
mkdir .\JBProject\res\model

xcopy .\res\music .\JBProject\res\music /S
xcopy .\res\role\*.dat .\JBProject\res\role\ /S
xcopy .\res\configure.cfg .\JBProject\res\ /S
xcopy .\res\icon.png .\JBProject\res\ /S
xcopy .\res\model .\JBProject\res\model /S

xcopy .\src .\JBProject\src /S

.\tools\ImgBuilderCmd\ImgBuilderCmd.exe res.sprcmd

pause