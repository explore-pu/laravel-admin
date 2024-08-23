import{_ as s,c as a,o as i,a5 as n}from"./chunks/framework.IdkiGMKn.js";const c=JSON.parse('{"title":"控制台命令","description":"","frontmatter":{},"headers":[],"relativePath":"guide/commands.md","filePath":"guide/commands.md"}'),e={name:"guide/commands.md"},t=n(`<h1 id="控制台命令" tabindex="-1">控制台命令 <a class="header-anchor" href="#控制台命令" aria-label="Permalink to &quot;控制台命令&quot;">​</a></h1><p><code>laravel-admin</code>内置了几个控制台命令来帮助开发，安装好laravel-admin之后，就可以直接使用它们了</p><h2 id="artisan-admin" tabindex="-1">artisan admin <a class="header-anchor" href="#artisan-admin" aria-label="Permalink to &quot;artisan admin&quot;">​</a></h2><p>使用<code>php artisan admin</code>命令可以显示当前<code>laravel-admin</code>的版本，以及列出所有可用的admin命令</p><div class="language-shell vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">shell</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">$</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> php</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> artisan</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin</span></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">laravel-admin</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> version</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> v1.0.5</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">Available</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> commands:</span></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> admin:make</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">              Make</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> controller</span></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> admin:controller</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">        Make</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> controller</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> from</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> giving</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> model</span></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> admin:menu</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">              Show</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> the</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> menu</span></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> admin:install</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">           Install</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> the</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> package</span></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> admin:publish</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">           re-publish</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> laravel-admin&#39;s assets, configuration, language and migration files. If you want overwrite the existing files, you can add the \`--force\` option</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:uninstall         Uninstall the admin package</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:import            Import a laravel-admin extension</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:create-user       Create a admin user</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:reset-password    Reset password for a specific admin user</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:extend            Build a laravel-admin extension</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:export-seed       Export seed a laravel-admin database tables menu, roles and permissions</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:minify            Minify the CSS and JS</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:form              Make admin form widget</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:permissions       generate admin permission base on table name</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:action            Make a admin action</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:generate-menu     Generate menu items based on registered routes.</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:config            Compare the difference between the admin config file and the original</span></span></code></pre></div><h2 id="artisan-admin-make" tabindex="-1">artisan admin:make <a class="header-anchor" href="#artisan-admin-make" aria-label="Permalink to &quot;artisan admin:make&quot;">​</a></h2><p>这个命令用来创建admin控制器，传入一个model，它会根据model对应表的字段，默认构建出所需的table，form和show三个页面的代码，</p><div class="language-shell vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">shell</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">$</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> php</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> artisan</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:make</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> PostController</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> --model=App\\\\Models\\\\Post</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">//</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> 在windows系统中</span></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">$</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> php</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> artisan</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:make</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> PostController</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> --model=App\\Models\\Post</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">App\\Admin\\Controllers\\PostController</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> created</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> successfully.</span></span></code></pre></div><p>然后打开<code>app/Admin/Controllers/PostController.php</code>, 就可以看到这个命令生成的代码了.</p><p>如果加上参数<code>--output</code>或者<code>-O</code>, 将会打印出代码，而不会创建控制器文件</p><h2 id="artisan-admin-form" tabindex="-1">artisan admin:form <a class="header-anchor" href="#artisan-admin-form" aria-label="Permalink to &quot;artisan admin:form&quot;">​</a></h2><p>用来生成一个表单类</p><div class="language-shell vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">shell</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">$</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> php</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> artisan</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:form</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> UserSetting</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> --title=用户设置</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">App\\Admin\\Forms\\UserSetting</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> created</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> successfully.</span></span></code></pre></div><h2 id="artisan-admin-install-artisan-admin-uninstall" tabindex="-1">artisan admin:install &amp; artisan admin:uninstall <a class="header-anchor" href="#artisan-admin-install-artisan-admin-uninstall" aria-label="Permalink to &quot;artisan admin:install &amp; artisan admin:uninstall&quot;">​</a></h2><p>这两个命令分别用来安装和卸载laravel-admin包</p><h2 id="artisan-admin-create-user" tabindex="-1">artisan admin:create-user <a class="header-anchor" href="#artisan-admin-create-user" aria-label="Permalink to &quot;artisan admin:create-user&quot;">​</a></h2><p>这个命令用来创建一个admin用户，用交互式的方式填写用户名和密码、并且选择角色之后，会创建一个可登录的用户</p><div class="language-shell vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">shell</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">php</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> artisan</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:create-user</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">Please</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> enter</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> a</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> username</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> to</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> login:</span></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">&gt;</span></span></code></pre></div><h2 id="artisan-admin-reset-password" tabindex="-1">artisan admin:reset-password <a class="header-anchor" href="#artisan-admin-reset-password" aria-label="Permalink to &quot;artisan admin:reset-password&quot;">​</a></h2><p>这个命令用来给指定用户重置密码，根据命令的提示来操作</p><div class="language-shell vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">shell</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">php</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> artisan</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> admin:reset-password</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">Please</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> enter</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> a</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> username</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> who</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> needs</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> to</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> reset</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> his</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> password:</span></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">&gt;</span></span></code></pre></div><h2 id="artisan-admin-import" tabindex="-1">artisan admin:import <a class="header-anchor" href="#artisan-admin-import" aria-label="Permalink to &quot;artisan admin:import&quot;">​</a></h2><p>这个命令用来在安装一个laravel-admin扩展之后，导入相关配置，具体的用法正在各个扩展的文档里面</p><h2 id="artisan-admin-menu" tabindex="-1">artisan admin:menu <a class="header-anchor" href="#artisan-admin-menu" aria-label="Permalink to &quot;artisan admin:menu&quot;">​</a></h2><p>这是个没什么卵用的命令，用来以json的格式列出左侧菜单数据</p>`,25),l=[t];function h(p,k,r,d,F,o){return i(),a("div",null,l)}const g=s(e,[["render",h]]);export{c as __pageData,g as default};
