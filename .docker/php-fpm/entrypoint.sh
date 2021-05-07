#!/bin/sh

#!/bin/bash

# Start the first process
/usr/sbin/php-fpm --nodaemonize -D
status=$?
if [ $status -ne 0 ]; then
  echo "Failed to start my_first_process: $status"
  exit $status
fi

# Start the second process
exec /usr/sbin/sshd -D
status=$?
if [ $status -ne 0 ]; then
  echo "Failed to start my_second_process: $status"
  exit $status
fi

#exec "$@"