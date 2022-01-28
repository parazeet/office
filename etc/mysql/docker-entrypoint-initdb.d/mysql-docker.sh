#!/bin/bash

mysql -uroot -proot -hlocalhost -P3306 test < /application/backup.sql
