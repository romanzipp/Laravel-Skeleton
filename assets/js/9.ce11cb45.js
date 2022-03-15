(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{407:function(t,a,s){"use strict";s.r(a);var n=s(56),e=Object(n.a)({},(function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("ContentSlotsDistributor",{attrs:{"slot-key":t.$parent.slotKey}},[s("h1",{attrs:{id:"docker"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#docker"}},[t._v("#")]),t._v(" Docker")]),t._v(" "),s("h2",{attrs:{id:"build-containers"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#build-containers"}},[t._v("#")]),t._v(" Build containers")]),t._v(" "),s("h3",{attrs:{id:"web"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#web"}},[t._v("#")]),t._v(" web")]),t._v(" "),s("p",[t._v("The "),s("code",[t._v("web")]),t._v(" container comes with nginx and php8.1-fpm.")]),t._v(" "),s("div",{staticClass:"language-shell extra-class"},[s("pre",{pre:!0,attrs:{class:"language-shell"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[t._v("docker")]),t._v(" build -t web "),s("span",{pre:!0,attrs:{class:"token builtin class-name"}},[t._v(".")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  -f .docker/web/Dockerfile "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  --build-arg "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"NOVA_USERNAME="')]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  --build-arg "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"NOVA_PASSWORD="')]),t._v("\n")])])]),s("div",{staticClass:"language-shell extra-class"},[s("pre",{pre:!0,attrs:{class:"language-shell"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[t._v("docker")]),t._v(" run --name web "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  -p "),s("span",{pre:!0,attrs:{class:"token number"}},[t._v("80")]),t._v(":80 "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  -v "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"'),s("span",{pre:!0,attrs:{class:"token variable"}},[s("span",{pre:!0,attrs:{class:"token variable"}},[t._v("$(")]),s("span",{pre:!0,attrs:{class:"token builtin class-name"}},[t._v("pwd")]),s("span",{pre:!0,attrs:{class:"token variable"}},[t._v(")")])]),t._v('/.docker/web/app.conf:/etc/nginx/conf.d/app.conf"')]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  -v "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"'),s("span",{pre:!0,attrs:{class:"token variable"}},[s("span",{pre:!0,attrs:{class:"token variable"}},[t._v("$(")]),s("span",{pre:!0,attrs:{class:"token builtin class-name"}},[t._v("pwd")]),s("span",{pre:!0,attrs:{class:"token variable"}},[t._v(")")])]),t._v('/.env:/app/.env"')]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  web\n")])])]),s("h3",{attrs:{id:"queue"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#queue"}},[t._v("#")]),t._v(" queue")]),t._v(" "),s("p",[t._v("The "),s("code",[t._v("queue")]),t._v(" container will run the "),s("code",[t._v("artisan queue:work")]),t._v(" command. An additional "),s("code",[t._v("QUEUE")]),t._v(" environment variable can be passed to configure the queue name.")]),t._v(" "),s("div",{staticClass:"language-shell extra-class"},[s("pre",{pre:!0,attrs:{class:"language-shell"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[t._v("docker")]),t._v(" build -t queue "),s("span",{pre:!0,attrs:{class:"token builtin class-name"}},[t._v(".")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  -f .docker/queue/Dockerfile "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  --build-arg "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"NOVA_USERNAME="')]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  --build-arg "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"NOVA_PASSWORD="')]),t._v("\n")])])]),s("div",{staticClass:"language-shell extra-class"},[s("pre",{pre:!0,attrs:{class:"language-shell"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[t._v("docker")]),t._v(" run --name queue "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  -v "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"'),s("span",{pre:!0,attrs:{class:"token variable"}},[s("span",{pre:!0,attrs:{class:"token variable"}},[t._v("$(")]),s("span",{pre:!0,attrs:{class:"token builtin class-name"}},[t._v("pwd")]),s("span",{pre:!0,attrs:{class:"token variable"}},[t._v(")")])]),t._v('/.env:/app/.env"')]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  -e "),s("span",{pre:!0,attrs:{class:"token assign-left variable"}},[t._v("QUEUE")]),s("span",{pre:!0,attrs:{class:"token operator"}},[t._v("=")]),t._v("default "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  queue\n")])])]),s("h3",{attrs:{id:"scheduler"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#scheduler"}},[t._v("#")]),t._v(" scheduler")]),t._v(" "),s("p",[t._v("The "),s("code",[t._v("scheduler")]),t._v(" container will execute the "),s("code",[t._v("artisan schedule:run")]),t._v(" command every 60 seconds. This replaces a cron-based setup.")]),t._v(" "),s("div",{staticClass:"language-shell extra-class"},[s("pre",{pre:!0,attrs:{class:"language-shell"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[t._v("docker")]),t._v(" build -t scheduler "),s("span",{pre:!0,attrs:{class:"token builtin class-name"}},[t._v(".")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  -f .docker/scheduler/Dockerfile "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  --build-arg "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"NOVA_USERNAME="')]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  --build-arg "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"NOVA_PASSWORD="')]),t._v("\n")])])]),s("div",{staticClass:"language-shell extra-class"},[s("pre",{pre:!0,attrs:{class:"language-shell"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[t._v("docker")]),t._v(" run --name scheduler "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  -v "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"'),s("span",{pre:!0,attrs:{class:"token variable"}},[s("span",{pre:!0,attrs:{class:"token variable"}},[t._v("$(")]),s("span",{pre:!0,attrs:{class:"token builtin class-name"}},[t._v("pwd")]),s("span",{pre:!0,attrs:{class:"token variable"}},[t._v(")")])]),t._v('/.env:/app/.env"')]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("\\")]),t._v("\n  scheduler\n")])])]),s("h2",{attrs:{id:"docker-compose"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#docker-compose"}},[t._v("#")]),t._v(" Docker Compose")]),t._v(" "),s("h3",{attrs:{id:"production-docker-compose-yml"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#production-docker-compose-yml"}},[t._v("#")]),t._v(" Production docker-compose.yml")]),t._v(" "),s("p",[s("strong",[t._v("Note")]),t._v(": You will need to specify the following environment variables.  See "),s("a",{attrs:{href:"/.docker/.env.example"}},[t._v("the Docker .env.example")]),t._v(" file for more information.")]),t._v(" "),s("ul",[s("li",[s("code",[t._v("REPOSITORY_URL")]),t._v(" Container registry URL ("),s("code",[t._v("___.dkr.ecr.___.amazonaws.com")]),t._v(")")])]),t._v(" "),s("h4",{attrs:{id:"start-docker-stack"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#start-docker-stack"}},[t._v("#")]),t._v(" Start docker stack")]),t._v(" "),s("div",{staticClass:"language-shell extra-class"},[s("pre",{pre:!0,attrs:{class:"language-shell"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[t._v("docker-compose")]),t._v(" -p skeleton_production -f docker-compose.yml up\n")])])]),s("div",{staticClass:"language-yml extra-class"},[s("pre",{pre:!0,attrs:{class:"language-yml"}},[s("code",[s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("version")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"3.9"')]),t._v("\n\n"),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("services")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("web")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("container_name")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" web\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("image")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"${REPOSITORY_URL}/skeleton:role-web"')]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("restart")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" unless"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("stopped\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("env_file")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" ../.env "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("volumes")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" ./web/app.conf"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("/etc/nginx/conf.d/app.conf\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" ../.env"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("/app/.env\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("ports")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"8000:80"')]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("networks")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" app"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("network "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("backend-queue")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("container_name")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" backend"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("queue\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("image")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"${REPOSITORY_URL}/skeleton:role-queue"')]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("restart")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" unless"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("stopped\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("env_file")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" ../.env "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("environment")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("QUEUE")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" default\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("volumes")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" ../.env"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("/app/.env\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("networks")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" app"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("network "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("depends_on")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" database"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(",")]),t._v(" backend "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("backend-scheduler")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("container_name")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" backend"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("scheduler\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("image")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"${REPOSITORY_URL}/skeleton:role-scheduler"')]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("restart")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" unless"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("stopped\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("env_file")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" ../.env "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("volumes")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" ../.env"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("/app/.env\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("networks")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" app"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("network "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("depends_on")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" database"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(",")]),t._v(" backend "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("database")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("container_name")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" database\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("image")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" mariadb"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("latest\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("restart")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" unless"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("stopped\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("ports")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"8001:3306"')]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("volumes")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" ./database"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("/var/lib/mysql\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("environment")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("MARIADB_ROOT_PASSWORD")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" $DB_ROOT_PASSWORD\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("MARIADB_ROOT_HOST")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"%"')]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("MARIADB_DATABASE")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" skeleton\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("networks")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" app"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("network "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("redis")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("container_name")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" redis\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("image")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" redis"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("latest\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("restart")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" unless"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("stopped\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("networks")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" app"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("network "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n\n"),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("networks")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("app-network")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("driver")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" bridge\n\n"),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("volumes")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("backend-volume")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n")])])]),s("h3",{attrs:{id:"local-docker-compose-yml"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#local-docker-compose-yml"}},[t._v("#")]),t._v(" Local docker-compose.yml")]),t._v(" "),s("p",[t._v("The local docker compose file uses the included Dockerfiles to build and spin up containers.")]),t._v(" "),s("p",[s("strong",[t._v("Note")]),t._v(": You will need to specify the following environment variables.  See "),s("a",{attrs:{href:"/.docker/.env.example"}},[t._v("the Docker .env.example")]),t._v(" file for more information.")]),t._v(" "),s("ul",[s("li",[s("code",[t._v("NOVA_USERNAME")]),t._v(" Laravel Nova username")]),t._v(" "),s("li",[s("code",[t._v("NOVA_PASSWORD")]),t._v(" Laravel Nova password/API key")]),t._v(" "),s("li",[s("code",[t._v("DB_ROOT_PASSWORD")]),t._v(" initial root password for database container")])]),t._v(" "),s("h4",{attrs:{id:"start-docker-stack-2"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#start-docker-stack-2"}},[t._v("#")]),t._v(" Start docker stack")]),t._v(" "),s("div",{staticClass:"language-shell extra-class"},[s("pre",{pre:!0,attrs:{class:"language-shell"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[t._v("docker-compose")]),t._v(" -p skeleton -f docker-compose.local.yml up\n")])])]),s("div",{staticClass:"language-shell extra-class"},[s("pre",{pre:!0,attrs:{class:"language-shell"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[t._v("docker-compose")]),t._v(" -p skeleton -f docker-compose.local.yml up --build\n")])])]),s("h4",{attrs:{id:"migrate-database"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#migrate-database"}},[t._v("#")]),t._v(" Migrate database")]),t._v(" "),s("div",{staticClass:"language-shell extra-class"},[s("pre",{pre:!0,attrs:{class:"language-shell"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[t._v("docker")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token builtin class-name"}},[t._v("exec")]),t._v(" -it web php artisan migrate\n")])])]),s("p",[t._v("You should be able to access the skeleton at "),s("a",{attrs:{href:"http://localhost:8000",target:"_blank",rel:"noopener noreferrer"}},[t._v("localhost:8000"),s("OutboundLink")],1),t._v(".")]),t._v(" "),s("div",{staticClass:"language-yml extra-class"},[s("pre",{pre:!0,attrs:{class:"language-yml"}},[s("code",[s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("version")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"3.9"')]),t._v("\n\n"),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("services")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("web")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("container_name")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" web\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("restart")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" unless"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("stopped\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("env_file")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" ../.env "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("build")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("context")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" /Users/roman/Code/laravel"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("skeleton\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("dockerfile")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" .docker/web/Dockerfile\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("args")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n        "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("NOVA_USERNAME")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" $NOVA_USERNAME\n        "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("NOVA_PASSWORD")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" $NOVA_PASSWORD\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("volumes")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" ./web/app.conf"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("/etc/nginx/conf.d/app.conf\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" ../.env"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("/app/.env\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("ports")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"8000:80"')]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("networks")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" app"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("network "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("backend-queue")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("container_name")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" backend"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("queue\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("restart")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" unless"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("stopped\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("env_file")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" ../.env "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("build")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("context")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" /Users/roman/Code/laravel"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("skeleton\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("dockerfile")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" .docker/queue/Dockerfile\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("args")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n        "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("NOVA_USERNAME")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" $NOVA_USERNAME\n        "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("NOVA_PASSWORD")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" $NOVA_PASSWORD\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("environment")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("QUEUE")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" default\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("volumes")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" ../.env"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("/app/.env\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("networks")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" app"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("network "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("depends_on")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" database"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(",")]),t._v(" backend "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("backend-scheduler")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("container_name")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" backend"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("scheduler\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("restart")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" unless"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("stopped\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("env_file")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" ../.env "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("build")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("context")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" /Users/roman/Code/laravel"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("skeleton\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("dockerfile")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" .docker/scheduler/Dockerfile\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("args")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n        "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("NOVA_USERNAME")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" $NOVA_USERNAME\n        "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("NOVA_PASSWORD")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" $NOVA_PASSWORD\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("volumes")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" ../.env"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("/app/.env\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("networks")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" app"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("network "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("depends_on")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" database"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(",")]),t._v(" backend "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("database")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("container_name")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" database\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("image")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" mariadb"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("latest\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("restart")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" unless"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("stopped\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("ports")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"8001:3306"')]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("volumes")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v(" ./database"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("/var/lib/mysql\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("environment")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("MARIADB_ROOT_PASSWORD")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" $DB_ROOT_PASSWORD\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("MARIADB_ROOT_HOST")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token string"}},[t._v('"%"')]),t._v("\n      "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("MARIADB_DATABASE")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" skeleton\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("networks")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" app"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("network "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("redis")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("container_name")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" redis\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("image")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" redis"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("latest\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("restart")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" unless"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("stopped\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("networks")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),t._v(" app"),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("-")]),t._v("network "),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),t._v("\n\n"),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("networks")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("app-network")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n    "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("driver")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v(" bridge\n\n"),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("volumes")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n  "),s("span",{pre:!0,attrs:{class:"token key atrule"}},[t._v("backend-volume")]),s("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n")])])])])}),[],!1,null,null,null);a.default=e.exports}}]);