#!/bin/sh

#!/bin/bash

# Start the first process
/usr/sbin/nginx
status=$?
if [ $status -ne 0 ]; then
  echo "Failed to start my_first_process: $status"
  exit $status
fi

#exec "$@"