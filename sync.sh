#!/usr/bin/env bash
# sync.sh — push local m4/ up to your Betaweb site
rsync -avz --delete \
  ./m4/ \
  sduprey2@betaweb.csug.rochester.edu:~/public_html/m4/
