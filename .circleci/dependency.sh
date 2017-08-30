#!/bin/bash

cat <<EOT > localsettings.php
<?php

define('TEST_API_KEY', '$TEST_API_KEY');
define('TEST_API_URL', '$TEST_API_URL');
EOT

