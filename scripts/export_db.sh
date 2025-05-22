#!/bin/bash
mysqldump -u [root] -p[38307350] [billing] > db/billing_dump_$(date +%Y-%m-%d).sql
