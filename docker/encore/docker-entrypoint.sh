#!/bin/sh
set -e

echo ">>> Yarn Install"
yarn

echo ">>> Yarn Build"
yarn build

echo ">>> OK!"
tail -f /dev/null