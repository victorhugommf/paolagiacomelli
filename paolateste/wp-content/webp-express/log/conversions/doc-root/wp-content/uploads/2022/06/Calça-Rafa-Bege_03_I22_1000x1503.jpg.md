WebP Express 0.25.5. Conversion triggered using bulk conversion, 2022-06-24 13:26:33

**WebP Convert 2.9.0 ignited** 
PHP version: 7.4.26
Server software: LiteSpeed

source: [doc-root]/wp-content/uploads/2022/06/Calça-Rafa-Bege_03_I22_1000x1503.jpg
destination: [doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calça-Rafa-Bege_03_I22_1000x1503.jpg.webp

**Stack converter ignited** 

Options:
------------
- encoding: "auto"
- quality: "auto"
- near-lossless: 60
- metadata: "none"
- log-call-arguments: true
- default-quality: 70** (deprecated)** 
- max-quality: 80** (deprecated)** 
- converters: (array of 10 items)

Note that these are the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options

Defaults:
------------
The following options was not set, so using the following defaults:
- auto-limit: true
- converter-options: (empty array)
- preferred-converters: (empty array)
- extra-converters: (empty array)
- shuffle: false


**cwebp converter ignited** 

Options:
------------
- encoding: "auto"
- quality: "auto"
- near-lossless: 60
- metadata: "none"
- method: 6
- low-memory: true
- log-call-arguments: true
- default-quality: 70** (deprecated)** 
- max-quality: 80** (deprecated)** 
- use-nice: true
- try-common-system-paths: true
- try-supplied-binary-for-os: true
- command-line-options: ""

Note that these are the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options

Defaults:
------------
The following options was not set, so using the following defaults:
- auto-limit: true
- alpha-quality: 85
- sharp-yuv: true
- auto-filter: false
- preset: "none"
- size-in-percentage: null (not set)
- try-cwebp: true
- try-discovering-cwebp: true
- skip-these-precompiled-binaries: ""
- rel-path-to-precompiled-binaries: *****

Encoding is set to auto - converting to both lossless and lossy and selecting the smallest file

Converting to lossy
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version 2>&1. Result: version: *0.3.0*
We could get the version, so yes, a plain cwebp call works (spent 9 ms)
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 2 binaries (spent 7 ms)
- /bin/cwebp
- /usr/bin/cwebp
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 2 binaries (spent 0 ms)
- /usr/bin/cwebp
- /bin/cwebp
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (Linux)... We do. We in fact have 4
Found 4 binaries (spent 0 ms)
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-120-linux-x86-64
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-linux-x86-64
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64
Discovering cwebp binaries took: 16 ms

Detecting versions of the cwebp binaries found (except supplied binaries)
- Executing: cwebp -version 2>&1. Result: version: *0.3.0*
- Executing: /bin/cwebp -version 2>&1. Result: version: *0.3.0*
- Executing: /usr/bin/cwebp -version 2>&1. Result: version: *0.3.0*
Detecting versions took: 23 ms
Binaries ordered by version number.
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-120-linux-x86-64: (version: 1.2.0)
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-linux-x86-64: (version: 1.1.0)
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static: (version: 1.0.3)
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64: (version: 0.6.1)
- cwebp: (version: 0.3.0)
- /bin/cwebp: (version: 0.3.0)
- /usr/bin/cwebp: (version: 0.3.0)
Starting conversion, using the first of these. If that should fail, the next will be tried and so on.
Tested "nice" command - it works :)
Checking checksum for supplied binary: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-120-linux-x86-64
Checksum test took: 33 ms
Creating command line options for version: 1.2.0
*Setting "quality" to "auto" is deprecated. Instead, set "quality" to a number (0-100) and "auto-limit" to true. 
*"quality" has been set to: 80 (took the value of "max-quality").*
*"auto-limit" has been set to: true."*
Running auto-limit
Quality setting: 80. 
Quality of jpeg: 96. 
Auto-limit result: 80 (no limiting needed this time).
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-120-linux-x86-64 -metadata none -q 80 -alpha_q '85' -sharp_yuv -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg.webp.lossy.webp' 2>&1

*Output:* 
nice: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-120-linux-x86-64: Permission denied

Executing cwebp binary took: 6 ms

Exec failed (return code: 126)
Note: You can prevent trying this precompiled binary, by setting the "skip-these-precompiled-binaries" option to "cwebp-120-linux-x86-64"
Checking checksum for supplied binary: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-linux-x86-64
Checksum test took: 20 ms
Creating command line options for version: 1.1.0
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-linux-x86-64 -metadata none -q 80 -alpha_q '85' -sharp_yuv -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg.webp.lossy.webp' 2>&1

*Output:* 
nice: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-linux-x86-64: Permission denied

Executing cwebp binary took: 6 ms

Exec failed (return code: 126)
Note: You can prevent trying this precompiled binary, by setting the "skip-these-precompiled-binaries" option to "cwebp-110-linux-x86-64"
Checking checksum for supplied binary: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static
Checksum test took: 33 ms
Creating command line options for version: 1.0.3
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static -metadata none -q 80 -alpha_q '85' -sharp_yuv -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg.webp.lossy.webp' 2>&1

*Output:* 
nice: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static: Permission denied

Executing cwebp binary took: 6 ms

Exec failed (return code: 126)
Note: You can prevent trying this precompiled binary, by setting the "skip-these-precompiled-binaries" option to "cwebp-103-linux-x86-64-static"
Checking checksum for supplied binary: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64
Checksum test took: 13 ms
Creating command line options for version: 0.6.1
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64 -metadata none -q 80 -alpha_q '85' -sharp_yuv -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg.webp.lossy.webp' 2>&1

*Output:* 
nice: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64: Permission denied

Executing cwebp binary took: 6 ms

Exec failed (return code: 126)
Note: You can prevent trying this precompiled binary, by setting the "skip-these-precompiled-binaries" option to "cwebp-061-linux-x86-64"
Creating command line options for version: 0.3.0
*Ignoring near-lossless option (requires cwebp 0.5)* 
*Ignoring sharp-yuv option (requires cwebp 0.6)* 
Trying to convert by executing the following command:
nice cwebp -metadata none -q 80 -alpha_q '85' -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg.webp.lossy.webp' 2>&1

*Output:* 
Error! Cannot open input file '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg'
Error! Cannot read input picture file '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg'

Executing cwebp binary took: 6 ms

Exec failed (return code: 255)
Creating command line options for version: 0.3.0
*Ignoring near-lossless option (requires cwebp 0.5)* 
*Ignoring sharp-yuv option (requires cwebp 0.6)* 
Trying to convert by executing the following command:
nice /bin/cwebp -metadata none -q 80 -alpha_q '85' -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg.webp.lossy.webp' 2>&1

*Output:* 
Error! Cannot open input file '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg'
Error! Cannot read input picture file '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg'

Executing cwebp binary took: 7 ms

Exec failed (return code: 255)
Creating command line options for version: 0.3.0
*Ignoring near-lossless option (requires cwebp 0.5)* 
*Ignoring sharp-yuv option (requires cwebp 0.6)* 
Trying to convert by executing the following command:
nice /usr/bin/cwebp -metadata none -q 80 -alpha_q '85' -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg.webp.lossy.webp' 2>&1

*Output:* 
Error! Cannot open input file '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg'
Error! Cannot read input picture file '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg'

Executing cwebp binary took: 7 ms

Exec failed (return code: 255)

**Error: ** **Failed converting. Check the conversion log for details.** 
Failed converting. Check the conversion log for details.
cwebp failed in 246 ms

**vips converter ignited** 

**Error: ** **Required Vips extension is not available.** 
Required Vips extension is not available.
vips failed in 0 ms

**imagemagick converter ignited** 

**Error: ** **imagemagick is not installed (cannot execute: "convert")** 
imagemagick is not installed (cannot execute: "convert")
imagemagick failed in 7 ms

**graphicsmagick converter ignited** 

Options:
------------
- encoding: "auto"
- quality: "auto"
- near-lossless: 60** (unsupported by graphicsmagick)** 
- metadata: "none"
- log-call-arguments: true
- default-quality: 70** (deprecated)** 
- max-quality: 80** (deprecated)** 
- use-nice: true

Note that these are the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options

Defaults:
------------
The following options was not set, so using the following defaults:
- auto-limit: true
- alpha-quality: 85
- method: 6
- sharp-yuv: true
- auto-filter: false
- low-memory: false
- preset: "none"

Encoding is set to auto - converting to both lossless and lossy and selecting the smallest file

Converting to lossy
Version: GraphicsMagick 1.3.34 2019-12-24 Q16 
*Setting "quality" to "auto" is deprecated. Instead, set "quality" to a number (0-100) and "auto-limit" to true. 
*"quality" has been set to: 80 (took the value of "max-quality").*
*"auto-limit" has been set to: true."*
Running auto-limit
Quality setting: 80. 
Quality of jpeg: 96. 
Auto-limit result: 80 (no limiting needed this time).
Tested "nice" command - it works :)
Executing command: nice gm convert -quality '80' -define webp:lossless=false -define webp:alpha-quality=85 -define webp:use-sharp-yuv=true -strip -define webp:method=6 '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg' 'webp:[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg.webp.lossy.webp' 2>&1

*Output:* 
gm convert: Unable to open file ([doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg) [No such file or directory].

return code: 1
command:nice gm convert -quality '80' -define webp:lossless=false -define webp:alpha-quality=85 -define webp:use-sharp-yuv=true -strip -define webp:method=6 '[doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg' 'webp:[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg.webp.lossy.webp' 2>&1
return code:1
output:gm convert: Unable to open file ([doc-root]/wp-content/uploads/2022/06/Calca-Rafa-Bege_03_I22_1000x1503.jpg) [No such file or directory].

**Error: ** **The exec() call failed** 
The exec() call failed
graphicsmagick failed in 80 ms

**ffmpeg converter ignited** 

**Error: ** **ffmpeg is not installed (cannot execute: "ffmpeg")** 
ffmpeg is not installed (cannot execute: "ffmpeg")
ffmpeg failed in 7 ms

**wpc converter ignited** 

**Error: ** **Missing URL. You must install Webp Convert Cloud Service on a server, or the WebP Express plugin for Wordpress - and supply the url.** 
Missing URL. You must install Webp Convert Cloud Service on a server, or the WebP Express plugin for Wordpress - and supply the url.
wpc failed in 0 ms

**ewww converter ignited** 

**Error: ** **Missing API key.** 
Missing API key.
ewww failed in 0 ms

**imagick converter ignited** 

Options:
------------
- encoding: "auto"
- quality: "auto"
- near-lossless: 60
- metadata: "none"
- log-call-arguments: true
- default-quality: 70** (deprecated)** 
- max-quality: 80** (deprecated)** 

Note that these are the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options

Defaults:
------------
The following options was not set, so using the following defaults:
- auto-limit: true
- alpha-quality: 85
- method: 6
- sharp-yuv: true
- auto-filter: false
- low-memory: false
- preset: "none"

Encoding is set to auto - converting to both lossless and lossy and selecting the smallest file

Converting to lossy
ImageMagic API version (full): ImageMagick 7.1.0-2 Q16 x86_64 2021-06-25 https://imagemagick.org
ImageMagic API version (just the number): 7.1.0-2
Imagic extension version: 3.5.1
*Setting "quality" to "auto" is deprecated. Instead, set "quality" to a number (0-100) and "auto-limit" to true. 
*"quality" has been set to: 80 (took the value of "max-quality").*
*"auto-limit" has been set to: true."*
Running auto-limit
Quality setting: 80. 
Quality of jpeg: 96. 
Auto-limit result: 80 (no limiting needed this time).
Reduction: 90% (went from 251 kb to 26 kb)

Converting to lossless
ImageMagic API version (full): ImageMagick 7.1.0-2 Q16 x86_64 2021-06-25 https://imagemagick.org
ImageMagic API version (just the number): 7.1.0-2
Imagic extension version: 3.5.1
Reduction: -142% (went from 251 kb to 607 kb)

Picking lossy
imagick succeeded :)

Converted image in 7985 ms, reducing file size with 90% (went from 251 kb to 26 kb)
