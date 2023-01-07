WebP Express 0.25.5. Conversion triggered using bulk conversion, 2022-06-24 16:15:00

**WebP Convert 2.9.0 ignited** 
PHP version: 7.4.26
Server software: LiteSpeed

source: [doc-root]/wp-content/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg
destination: [doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg.webp

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
We could get the version, so yes, a plain cwebp call works (spent 8 ms)
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
Checksum test took: 24 ms
Creating command line options for version: 1.2.0
*Setting "quality" to "auto" is deprecated. Instead, set "quality" to a number (0-100) and "auto-limit" to true. 
*"quality" has been set to: 80 (took the value of "max-quality").*
*"auto-limit" has been set to: true."*
Running auto-limit
Quality setting: 80. 
Quality of jpeg: 82. 
Auto-limit result: 80 (no limiting needed this time).
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-120-linux-x86-64 -metadata none -q 80 -alpha_q '85' -sharp_yuv -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg.webp.lossy.webp' 2>&1

*Output:* 
nice: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-120-linux-x86-64: Permission denied

Executing cwebp binary took: 8 ms

Exec failed (return code: 126)
Note: You can prevent trying this precompiled binary, by setting the "skip-these-precompiled-binaries" option to "cwebp-120-linux-x86-64"
Checking checksum for supplied binary: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-linux-x86-64
Checksum test took: 20 ms
Creating command line options for version: 1.1.0
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-linux-x86-64 -metadata none -q 80 -alpha_q '85' -sharp_yuv -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg.webp.lossy.webp' 2>&1

*Output:* 
nice: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-linux-x86-64: Permission denied

Executing cwebp binary took: 9 ms

Exec failed (return code: 126)
Note: You can prevent trying this precompiled binary, by setting the "skip-these-precompiled-binaries" option to "cwebp-110-linux-x86-64"
Checking checksum for supplied binary: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static
Checksum test took: 36 ms
Creating command line options for version: 1.0.3
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static -metadata none -q 80 -alpha_q '85' -sharp_yuv -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg.webp.lossy.webp' 2>&1

*Output:* 
nice: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static: Permission denied

Executing cwebp binary took: 8 ms

Exec failed (return code: 126)
Note: You can prevent trying this precompiled binary, by setting the "skip-these-precompiled-binaries" option to "cwebp-103-linux-x86-64-static"
Checking checksum for supplied binary: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64
Checksum test took: 13 ms
Creating command line options for version: 0.6.1
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64 -metadata none -q 80 -alpha_q '85' -sharp_yuv -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg.webp.lossy.webp' 2>&1

*Output:* 
nice: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64: Permission denied

Executing cwebp binary took: 7 ms

Exec failed (return code: 126)
Note: You can prevent trying this precompiled binary, by setting the "skip-these-precompiled-binaries" option to "cwebp-061-linux-x86-64"
Creating command line options for version: 0.3.0
*Ignoring near-lossless option (requires cwebp 0.5)* 
*Ignoring sharp-yuv option (requires cwebp 0.6)* 
Trying to convert by executing the following command:
nice cwebp -metadata none -q 80 -alpha_q '85' -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg.webp.lossy.webp' 2>&1

*Output:* 
Saving file '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg.webp.lossy.webp'
File:      [doc-root]/wp-content/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg
Dimension: 666 x 1001
Output:    20466 bytes Y-U-V-All-PSNR 44.96 48.72 51.39   46.07 dB
block count:  intra4: 578
              intra16: 2068  (-> 78.16%)
              skipped block: 927 (35.03%)
bytes used:  header:            177  (0.9%)
             mode-partition:   3836  (18.7%)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |    1033 |    4840 |    4228 |     960 |   11061  (54.0%)
 intra16-coeffs:  |       0 |      87 |     944 |    2702 |    3733  (18.2%)
  chroma coeffs:  |     103 |     834 |     544 |     151 |    1632  (8.0%)
    macroblocks:  |       0%|       6%|      12%|      80%|    2646
      quantizer:  |      27 |      27 |      23 |      18 |
   filter level:  |      12 |       9 |       6 |       4 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |    1136 |    5761 |    5716 |    3813 |   16426  (80.3%)

Executing cwebp binary took: 272 ms

Success
Reduction: 67% (went from 60 kb to 20 kb)

Converting to lossless
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version 2>&1. Result: version: *0.3.0*
We could get the version, so yes, a plain cwebp call works (spent 9 ms)
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 2 binaries (spent 8 ms)
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
Discovering cwebp binaries took: 17 ms

Detecting versions of the cwebp binaries found (except supplied binaries)
- Executing: cwebp -version 2>&1. Result: version: *0.3.0*
- Executing: /bin/cwebp -version 2>&1. Result: version: *0.3.0*
- Executing: /usr/bin/cwebp -version 2>&1. Result: version: *0.3.0*
Detecting versions took: 24 ms
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
Checksum test took: 25 ms
Creating command line options for version: 1.2.0
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-120-linux-x86-64 -metadata none -q 80 -alpha_q '85' -near_lossless 60 -sharp_yuv -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg.webp.lossless.webp' 2>&1

*Output:* 
nice: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-120-linux-x86-64: Permission denied

Executing cwebp binary took: 8 ms

Exec failed (return code: 126)
Note: You can prevent trying this precompiled binary, by setting the "skip-these-precompiled-binaries" option to "cwebp-120-linux-x86-64"
Checking checksum for supplied binary: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-linux-x86-64
Checksum test took: 20 ms
Creating command line options for version: 1.1.0
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-linux-x86-64 -metadata none -q 80 -alpha_q '85' -near_lossless 60 -sharp_yuv -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg.webp.lossless.webp' 2>&1

*Output:* 
nice: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-linux-x86-64: Permission denied

Executing cwebp binary took: 8 ms

Exec failed (return code: 126)
Note: You can prevent trying this precompiled binary, by setting the "skip-these-precompiled-binaries" option to "cwebp-110-linux-x86-64"
Checking checksum for supplied binary: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static
Checksum test took: 38 ms
Creating command line options for version: 1.0.3
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static -metadata none -q 80 -alpha_q '85' -near_lossless 60 -sharp_yuv -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg.webp.lossless.webp' 2>&1

*Output:* 
nice: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static: Permission denied

Executing cwebp binary took: 9 ms

Exec failed (return code: 126)
Note: You can prevent trying this precompiled binary, by setting the "skip-these-precompiled-binaries" option to "cwebp-103-linux-x86-64-static"
Checking checksum for supplied binary: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64
Checksum test took: 17 ms
Creating command line options for version: 0.6.1
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64 -metadata none -q 80 -alpha_q '85' -near_lossless 60 -sharp_yuv -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg.webp.lossless.webp' 2>&1

*Output:* 
nice: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64: Permission denied

Executing cwebp binary took: 8 ms

Exec failed (return code: 126)
Note: You can prevent trying this precompiled binary, by setting the "skip-these-precompiled-binaries" option to "cwebp-061-linux-x86-64"
Creating command line options for version: 0.3.0
*Ignoring near-lossless option (requires cwebp 0.5)* 
*Ignoring sharp-yuv option (requires cwebp 0.6)* 
Trying to convert by executing the following command:
nice cwebp -metadata none -q 80 -alpha_q '85' -lossless -m 6 -low_memory '[doc-root]/wp-content/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg.webp.lossless.webp' 2>&1

*Output:* 
Saving file '[doc-root]/wp-content/webp-express/webp-images/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg.webp.lossless.webp'
File:      [doc-root]/wp-content/uploads/2022/06/Calca-Jessika-Preto_04_I22_1000x1503-666x1001.jpg
Dimension: 666 x 1001
Output:    178636 bytes
Lossless-ARGB compressed size: 178636 bytes
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=5 transform=3 cache=0

Executing cwebp binary took: 2198 ms

Success
Reduction: -189% (went from 60 kb to 174 kb)

Picking lossy
cwebp succeeded :)

Converted image in 2840 ms, reducing file size with 67% (went from 60 kb to 20 kb)
