{
	"Id": "e8b54d5e8fd26ff04d2d43b630ce40f509d65a66d66de02cebf300464ffd6257",
	"Created": "2024-04-30T00:01:27.936663363Z",
	"Path": "docker-entrypoint.sh",
	"Args": [
		"apache2-foreground"
	],
	"State": {
		"Status": "running",
		"Running": true,
		"Paused": false,
		"Restarting": false,
		"OOMKilled": false,
		"Dead": false,
		"Pid": 5366,
		"ExitCode": 0,
		"Error": "",
		"StartedAt": "2024-05-19T08:58:02.289181928Z",
		"FinishedAt": "2024-05-19T08:49:14.763627783Z"
	},
	"Image": "sha256:043bd1522bd8a989041881081a83385915d8534bf6e0960be0adfc0dc4d21bfe",
	"ResolvConfPath": "/var/lib/docker/containers/e8b54d5e8fd26ff04d2d43b630ce40f509d65a66d66de02cebf300464ffd6257/resolv.conf",
	"HostnamePath": "/var/lib/docker/containers/e8b54d5e8fd26ff04d2d43b630ce40f509d65a66d66de02cebf300464ffd6257/hostname",
	"HostsPath": "/var/lib/docker/containers/e8b54d5e8fd26ff04d2d43b630ce40f509d65a66d66de02cebf300464ffd6257/hosts",
	"LogPath": "/var/lib/docker/containers/e8b54d5e8fd26ff04d2d43b630ce40f509d65a66d66de02cebf300464ffd6257/e8b54d5e8fd26ff04d2d43b630ce40f509d65a66d66de02cebf300464ffd6257-json.log",
	"Name": "/dev_wp_env_wordpress_1",
	"RestartCount": 0,
	"Driver": "overlay2",
	"Platform": "linux",
	"MountLabel": "",
	"ProcessLabel": "",
	"AppArmorProfile": "",
	"ExecIDs": [
		"6db62fbf9a36496377eb5d4a945ada45fc56c73cd2d0a22a88dcdb4b3ea8c7bf",
		"e6fd0abe72499a979caf1b0c282e89a859dfb1b688aa9fe9d40dcf4b568f7fda",
		"87918f22fe66380db3b4dc3b3a3c6aad4123b21c2cadcad43200fefa57fc5b55",
		"684f39d2448471ed06a2965e0cf0c85f41e9f28d9d57730c7a94d867ab66bf42",
		"d619deb73bd5b7b5b4aae9392daf8a7dd3022881a328d5244035ad58310ce22e",
		"fb221aa34dd1671fdd2a5314a718d0d8cb75c8fa7e3bc130234ef073285f0a35",
		"70103494d15c8fc414a657ced63cb2a356ae65b65ff07dc5397e92b894170887",
		"b70fe34036b6e490ccd8a4b86413ed5a3ebd69fe3ba251febaf56aa8c04904dd",
		"2b3f570dd080ee67f22041a454cbb365810a480f2e8a906b4c85edbd3680a575",
		"48f9a40eec9f185bd392f3f4957dd7cf7a5a75dc44955e107f0aa21f608e2f20"
	],
	"HostConfig": {
		"Binds": [
			"/home/h95mori/dev_wp_env/html:/var/www/html:rw"
		],
		"ContainerIDFile": "",
		"LogConfig": {
			"Type": "json-file",
			"Config": {}
		},
		"NetworkMode": "dev_wp_env_default",
		"PortBindings": {
			"80/tcp": [
				{
					"HostIp": "",
					"HostPort": "7100"
				}
			]
		},
		"RestartPolicy": {
			"Name": "",
			"MaximumRetryCount": 0
		},
		"AutoRemove": false,
		"VolumeDriver": "",
		"VolumesFrom": [],
		"ConsoleSize": [
			0,
			0
		],
		"CapAdd": null,
		"CapDrop": null,
		"CgroupnsMode": "host",
		"Dns": [],
		"DnsOptions": [],
		"DnsSearch": [],
		"ExtraHosts": null,
		"GroupAdd": null,
		"IpcMode": "private",
		"Cgroup": "",
		"Links": null,
		"OomScoreAdj": 0,
		"PidMode": "",
		"Privileged": false,
		"PublishAllPorts": false,
		"ReadonlyRootfs": false,
		"SecurityOpt": null,
		"UTSMode": "",
		"UsernsMode": "",
		"ShmSize": 67108864,
		"Runtime": "runc",
		"Isolation": "",
		"CpuShares": 0,
		"Memory": 0,
		"NanoCpus": 0,
		"CgroupParent": "",
		"BlkioWeight": 0,
		"BlkioWeightDevice": null,
		"BlkioDeviceReadBps": null,
		"BlkioDeviceWriteBps": null,
		"BlkioDeviceReadIOps": null,
		"BlkioDeviceWriteIOps": null,
		"CpuPeriod": 0,
		"CpuQuota": 0,
		"CpuRealtimePeriod": 0,
		"CpuRealtimeRuntime": 0,
		"CpusetCpus": "",
		"CpusetMems": "",
		"Devices": null,
		"DeviceCgroupRules": null,
		"DeviceRequests": null,
		"MemoryReservation": 0,
		"MemorySwap": 0,
		"MemorySwappiness": null,
		"OomKillDisable": false,
		"PidsLimit": null,
		"Ulimits": null,
		"CpuCount": 0,
		"CpuPercent": 0,
		"IOMaximumIOps": 0,
		"IOMaximumBandwidth": 0,
		"MaskedPaths": [
			"/proc/asound",
			"/proc/acpi",
			"/proc/kcore",
			"/proc/keys",
			"/proc/latency_stats",
			"/proc/timer_list",
			"/proc/timer_stats",
			"/proc/sched_debug",
			"/proc/scsi",
			"/sys/firmware",
			"/sys/devices/virtual/powercap"
		],
		"ReadonlyPaths": [
			"/proc/bus",
			"/proc/fs",
			"/proc/irq",
			"/proc/sys",
			"/proc/sysrq-trigger"
		]
	},
	"GraphDriver": {
		"Data": {
			"LowerDir": "/var/lib/docker/overlay2/7cb8abc7ee87444a52cd7322e99611b49d2ae41c077199316ecb611d7ecf6ba4-init/diff:/var/lib/docker/overlay2/c1f006b2f903f8fa20b8540f1a380445f195ba6c83bff84ed04f84eac284fa42/diff:/var/lib/docker/overlay2/31f67f83046cd2f7ad2adaa515c9a5afdbba7c6119236148bcebb8bfd915075e/diff:/var/lib/docker/overlay2/999ce2da3349b978d544ca850f0dd1b91a70bbe6c36207577dc872a6b5201d54/diff:/var/lib/docker/overlay2/9614c6551714f74fcf7b6358ae0dced1fa52691a848e6364c9dda8ebecce9de3/diff:/var/lib/docker/overlay2/abb19ff1b8e85d1e10921601ebf9745d46456291e23d519d5327be8dd688e078/diff:/var/lib/docker/overlay2/c347b1add54e2763959c28f5b50c2f0108fabd0385efe0ff3faa237656be7050/diff:/var/lib/docker/overlay2/373fcc4c9cf9808d6670f715b925a717928a885e285ecc04c61a1287741bc192/diff:/var/lib/docker/overlay2/00d5b545a74ebec793b0b6dde518055be5b8e2a8a6165406f584fe7060d373af/diff:/var/lib/docker/overlay2/6b4cd76c7fc15a9370ad066726e7280ee5a5e76412ef65a1eaaa845907892fc1/diff:/var/lib/docker/overlay2/68a20a0b5d1b026220b3825d460af0fcc6c3d92046103df71061a082ed3b1305/diff:/var/lib/docker/overlay2/6745e1ad4eb759bff09a09582de1d69feaabac2caea14e07901cc9e751e12294/diff:/var/lib/docker/overlay2/31f0f491fbf16c8c22105e758c9d3639e282fd1d2b911fed85d7d154e5efbfdd/diff:/var/lib/docker/overlay2/50aebad07fbeb0f2b92c39dd166d56dcfd2d657edff97e4178c076dc20509a73/diff:/var/lib/docker/overlay2/2ae0caf32e506ff620ef8b0b5b4c60f26cefa55bc5ef5e5d81141b467cf96d97/diff:/var/lib/docker/overlay2/bb47309b0dd93e01ded2b79d2b0a3877e3b78f25148ff2fd7f7516c266a9903a/diff:/var/lib/docker/overlay2/9045e92ec0a116dc9b40ee7e8a2fe23b0a78b9e7ed7cec407d7eb8fe08c728d3/diff:/var/lib/docker/overlay2/e3e78d1ca4a104bc5131db0a22c58464e76204689a43b1d5fbe3d2af10a95632/diff:/var/lib/docker/overlay2/9fbe6bdc116c62ec4f8c8d8764da230daa12ee2ee1c7d7f02ac6345297168b47/diff:/var/lib/docker/overlay2/5189dccc68492a30d7dc6e6a14d2801d0f7e81004c9c28f7f9e1db3784fdb37a/diff:/var/lib/docker/overlay2/eb3506b7dec0e55d1d0c6c2954587caff6e5c3ab5933075cae886ab8bf765944/diff:/var/lib/docker/overlay2/7c271c4b0ecd1f7a2afd037ee4b3a4b482b69477de02365ac1e8a502af9f6069/diff",
			"MergedDir": "/var/lib/docker/overlay2/7cb8abc7ee87444a52cd7322e99611b49d2ae41c077199316ecb611d7ecf6ba4/merged",
			"UpperDir": "/var/lib/docker/overlay2/7cb8abc7ee87444a52cd7322e99611b49d2ae41c077199316ecb611d7ecf6ba4/diff",
			"WorkDir": "/var/lib/docker/overlay2/7cb8abc7ee87444a52cd7322e99611b49d2ae41c077199316ecb611d7ecf6ba4/work"
		},
		"Name": "overlay2"
	},
	"Mounts": [
		{
			"Type": "bind",
			"Source": "/home/h95mori/dev_wp_env/html",
			"Destination": "/var/www/html",
			"Mode": "rw",
			"RW": true,
			"Propagation": "rprivate"
		}
	],
	"Config": {
		"Hostname": "e8b54d5e8fd2",
		"Domainname": "",
		"User": "",
		"AttachStdin": false,
		"AttachStdout": false,
		"AttachStderr": false,
		"ExposedPorts": {
			"80/tcp": {}
		},
		"Tty": false,
		"OpenStdin": false,
		"StdinOnce": false,
		"Env": [
			"WORDPRESS_DB_HOST=db:3306",
			"WORDPRESS_DB_USER=wordpress",
			"WORDPRESS_DB_PASSWORD=hibashira10dev",
			"WORDPRESS_DB_NAME=wordpress",
			"PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin",
			"PHPIZE_DEPS=autoconf \t\tdpkg-dev \t\tfile \t\tg++ \t\tgcc \t\tlibc-dev \t\tmake \t\tpkg-config \t\tre2c",
			"PHP_INI_DIR=/usr/local/etc/php",
			"APACHE_CONFDIR=/etc/apache2",
			"APACHE_ENVVARS=/etc/apache2/envvars",
			"PHP_CFLAGS=-fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64",
			"PHP_CPPFLAGS=-fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64",
			"PHP_LDFLAGS=-Wl,-O1 -pie",
			"GPG_KEYS=1729F83938DA44E27BA0F4D3DBDB397470D12172 BFDDD28642824F8118EF77909B67A5C12229118F 2C16C765DBE54A088130F1BC4B9B5F600B55F3B4",
			"PHP_VERSION=8.0.29",
			"PHP_URL=https://www.php.net/distributions/php-8.0.29.tar.xz",
			"PHP_ASC_URL=https://www.php.net/distributions/php-8.0.29.tar.xz.asc",
			"PHP_SHA256=14db2fbf26c07d0eb2c9fab25dbde7e27726a3e88452cca671f0896bbb683ca9"
		],
		"Cmd": [
			"apache2-foreground"
		],
		"Image": "wordpress:latest",
		"Volumes": {
			"/var/www/html": {}
		},
		"WorkingDir": "/var/www/html",
		"Entrypoint": [
			"docker-entrypoint.sh"
		],
		"OnBuild": null,
		"Labels": {
			"com.docker.compose.config-hash": "162f0ed34078b5bc9825555227f48d5be771737c7ffb953922f759aff394cd15",
			"com.docker.compose.container-number": "1",
			"com.docker.compose.oneoff": "False",
			"com.docker.compose.project": "dev_wp_env",
			"com.docker.compose.project.config_files": "docker-compose.yml",
			"com.docker.compose.project.working_dir": "/home/h95mori/dev_wp_env",
			"com.docker.compose.service": "wordpress",
			"com.docker.compose.version": "1.27.4"
		},
		"StopSignal": "SIGWINCH"
	},
	"NetworkSettings": {
		"Bridge": "",
		"SandboxID": "b8f2298e363d19fb5a3f2c0929ee9738e017dd5ed6a794fd30dac654d50346d5",
		"HairpinMode": false,
		"LinkLocalIPv6Address": "",
		"LinkLocalIPv6PrefixLen": 0,
		"Ports": {
			"80/tcp": [
				{
					"HostIp": "0.0.0.0",
					"HostPort": "7100"
				},
				{
					"HostIp": "::",
					"HostPort": "7100"
				}
			]
		},
		"SandboxKey": "/var/run/docker/netns/b8f2298e363d",
		"SecondaryIPAddresses": null,
		"SecondaryIPv6Addresses": null,
		"EndpointID": "",
		"Gateway": "",
		"GlobalIPv6Address": "",
		"GlobalIPv6PrefixLen": 0,
		"IPAddress": "",
		"IPPrefixLen": 0,
		"IPv6Gateway": "",
		"MacAddress": "",
		"Networks": {
			"dev_wp_env_default": {
				"IPAMConfig": null,
				"Links": null,
				"Aliases": [
					"wordpress",
					"e8b54d5e8fd2"
				],
				"NetworkID": "354cc6ef0e2a440364765f73df36dca8cffd81cec4005ad3cf64c89a5f2cb2e3",
				"EndpointID": "e9ad7328ab209d308cd8878d544fe34dad25ffe5a48dca0ac6a38b58e45e0d30",
				"Gateway": "172.19.0.1",
				"IPAddress": "172.19.0.3",
				"IPPrefixLen": 16,
				"IPv6Gateway": "",
				"GlobalIPv6Address": "",
				"GlobalIPv6PrefixLen": 0,
				"MacAddress": "02:42:ac:13:00:03",
				"DriverOpts": null
			}
		}
	},
	"Ports": [
		{
			"IP": "0.0.0.0",
			"PrivatePort": 80,
			"PublicPort": 7100,
			"Type": "tcp"
		},
		{
			"IP": "::",
			"PrivatePort": 80,
			"PublicPort": 7100,
			"Type": "tcp"
		}
	]
}