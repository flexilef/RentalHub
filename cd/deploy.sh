#!/usr/bin/env bash
echo "deploying to sfsuswe.com"

ssh -v f16g16@sfsuswe.com <<f16g16
    cd ~/public_html/final_project
    git pull gitlab dev
f16g16