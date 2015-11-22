
sync:
	rsync -rav -e ssh --exclude='wp-content/uploads/*' --exclude='xampp' consultant@104.239.165.167:/var/www/vhosts/labfellows.com/ ./wordpress
