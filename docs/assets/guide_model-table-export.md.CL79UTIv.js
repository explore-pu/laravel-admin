import{_ as s,c as i,o as a,a5 as n}from"./chunks/framework.IdkiGMKn.js";const c=JSON.parse('{"title":"数据导出","description":"","frontmatter":{},"headers":[],"relativePath":"guide/model-table-export.md","filePath":"guide/model-table-export.md"}'),p={name:"guide/model-table-export.md"},l=n(`<h1 id="数据导出" tabindex="-1">数据导出 <a class="header-anchor" href="#数据导出" aria-label="Permalink to &quot;数据导出&quot;">​</a></h1><p><code>model-table</code>内置了csv格式文件的导出，默认将列表中显示的数据导出为csv格式的文件。</p><p>使用默认的csv导出，有下面一些可供使用的方法。</p><div class="language-php vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">$table</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">export</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">(</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">function</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> ($export) {</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">    $export</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">filename</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">(</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;Filename.csv&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">);</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">    $export</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">except</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">([</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;column1&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">, </span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;column2&#39;</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> ...</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">]);</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">    $export</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">only</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">([</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;column3&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">, </span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;column4&#39;</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> ...</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">]);</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">    $export</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">originalValue</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">([</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;column1&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">, </span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;column2&#39;</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> ...</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">]);</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">    $export</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">column</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">(</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;column_5&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">, </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">function</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> ($value, $original) {</span></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">        return</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> $value;</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">    });</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">});</span></span>
<span class="line"><span style="--shiki-light:#6A737D;--shiki-dark:#6A737D;">// $export-&gt;filename($filename);\`用来指定导出文件的名称，不设置的话默认为\`表名.csv</span></span></code></pre></div><p><code>$export-&gt;except([]);</code>用来指定哪些列不需要被导出，指定了之后，相关的列将不会被导出, 反之，使用<code>$export-&gt;only([]);</code>方法用来指定只能导出哪些列。</p><p>很多情况下某些列会被修改之后显示在页面上，比如对列使用了<code>$table-&gt;column(&#39;name&#39;)-&gt;label()</code>方法之后，那么导出的列内容会是一段HTML，如果需要某些列导出存在数据库中的原始内容，使用<code>originalValue</code>方法</p><div class="language-php vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">$export</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">originalValue</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">([</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;name&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">]);</span></span></code></pre></div><p>最后，如果你想自定义某些列的导出内容，使用<code>column</code>方法</p><div class="language-php vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">$export</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">column</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">(</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;column_5&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">, </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">function</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> ($value, $original) {</span></span>
<span class="line"><span style="--shiki-light:#6A737D;--shiki-dark:#6A737D;">    // return $value;</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">)};</span></span></code></pre></div><p>其中传入闭包函数中的<code>$value</code>和<code>$original</code>为该列的原始值和应用过某些方法之后被修改之后的值，你可以在闭包函数中实现自己的逻辑。</p><h2 id="laravel-excel-v3" tabindex="-1">Laravel-Excel v3.* <a class="header-anchor" href="#laravel-excel-v3" aria-label="Permalink to &quot;Laravel-Excel v3.*&quot;">​</a></h2><p>增加了对<code>Laravel-Excel 3.*</code>版本的导出支持。</p><p>首先按照文档安装好<a href="https://github.com/Maatwebsite/Laravel-Excel" target="_blank" rel="noreferrer">Laravel-Excel</a>。</p><p>然后创建导出类：</p><div class="language-php vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">&lt;?</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;">php</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">namespace</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> App\\Admin\\Extensions</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">use</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> Elegant\\Utils\\Table\\Exporters\\ExcelExporter</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">; </span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">class</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> PostsExporter</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> extends</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> ExcelExporter</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">{</span></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">    protected</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> $fileName </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">=</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> &#39;文章列表.xlsx&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">    protected</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> $columns </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">=</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> [</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">        &#39;id&#39;</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">      =&gt;</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> &#39;ID&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">,</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">        &#39;title&#39;</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">   =&gt;</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> &#39;标题&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">,</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">        &#39;content&#39;</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> =&gt;</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> &#39;内容&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">,</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">    ];</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">}</span></span></code></pre></div><p>然后在table中使用这个导出类：</p><div class="language-php vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">use</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> App\\Admin\\Extensions\\PostsExporter</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">$table</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">exporter</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">(</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">new</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> PostsExporter</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">());</span></span></code></pre></div><p>通过上面的<code>$columns</code>设置，导出时只会导出三个指定的三个字段，如果你要导出所有的字段，指定按照顺序指定每一个字段的名称即可</p><div class="language-php vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">class</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> PostsExporter</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> extends</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> ExcelExporter</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">{</span></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">    protected</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> $fileName </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">=</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> &#39;文章列表.xlsx&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">    protected</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> $headings </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">=</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> [</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;ID&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">, </span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;标题&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">, </span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;内容&#39;</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> ...</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> ];</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">}</span></span></code></pre></div><h2 id="数据修改" tabindex="-1">数据修改 <a class="header-anchor" href="#数据修改" aria-label="Permalink to &quot;数据修改&quot;">​</a></h2><p>按照上面的方法，会将数据库中存储的原始数据导出，如果你希望对数据进行预处理，参考下面的方式：</p><div class="language-php vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">&lt;?</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;">php</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">namespace</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> App\\Admin\\Extensions\\Export</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">use</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> Elegant\\Utils\\Table\\Exporters\\ExcelExporter</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">use</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> Maatwebsite\\Excel\\Concerns\\WithMapping</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">class</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> UsersExporter</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> extends</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> ExcelExporter</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> implements</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> WithMapping</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">{</span></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">    protected</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> $fileName </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">=</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> &#39;用户列表.xlsx&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">    protected</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> $columns </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">=</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> [</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">        &#39;id&#39;</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">                    =&gt;</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> &#39;ID&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">,</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">        &#39;name&#39;</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">                  =&gt;</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> &#39;姓名&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">,</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">        &#39;status&#39;</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">                =&gt;</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> &#39;状态&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">,</span></span>
<span class="line"><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">        &#39;profile.homepage&#39;</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">      =&gt;</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> &#39;主页&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">,</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">    ];</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">    public</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> function</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> map</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">($user) </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">:</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> array</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">    {</span></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">        return</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> [</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">            $user</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">id,</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">            $user</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">name,</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">            $user</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">status </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">?</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> &#39;yes&#39;</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> :</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> &#39;no&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;           </span><span style="--shiki-light:#6A737D;--shiki-dark:#6A737D;">// 字段数据替换</span></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">            data_get</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">($user, </span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;profile.homepage&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">),    </span><span style="--shiki-light:#6A737D;--shiki-dark:#6A737D;">// 读取关联关系数据</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">        ];</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">    }</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">}</span></span></code></pre></div><h2 id="laravel-excel-v2" tabindex="-1">Laravel-Excel v2.* <a class="header-anchor" href="#laravel-excel-v2" aria-label="Permalink to &quot;Laravel-Excel v2.*&quot;">​</a></h2><p>本示例用<a href="https://github.com/Maatwebsite/Laravel-Excel" target="_blank" rel="noreferrer">Laravel-Excel</a>作为excel操作库，当然也可以使用任何其他excel库</p><p>首先安装好它：</p><div class="language-bash vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">composer</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> require</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> maatwebsite/excel:~2.1.0</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">php</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> artisan</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;"> vendor:publish</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> --provider=</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&quot;Maatwebsite\\Excel\\ExcelServiceProvider&quot;</span></span></code></pre></div><p>然后新建自定义导出类，比如<code>app/Admin/Extensions/ExcelExpoter.php</code>:</p><div class="language-php vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">&lt;?</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;">php</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">namespace</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> App\\Admin\\Extensions</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">use</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> Elegant\\Utils\\Table\\Exporters\\AbstractExporter</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">use</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> Maatwebsite\\Excel\\Facades\\Excel</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">class</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> ExcelExpoter</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> extends</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> AbstractExporter</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">{</span></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">    public</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;"> function</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> export</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">()</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">    {</span></span>
<span class="line"><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;">        Excel</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">::</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">create</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">(</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;Filename&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">, </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">function</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">($excel) {</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">            $excel</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">sheet</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">(</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;Sheetname&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">, </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">function</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">($sheet) {</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#6A737D;--shiki-dark:#6A737D;">                // 这段逻辑是从表格数据中取出需要导出的字段</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">                $rows </span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">=</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> collect</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">(</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;">$this</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">getData</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">())</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">map</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">(</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">function</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;"> ($item) {</span></span>
<span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">                    return</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;"> array_only</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">($item, [</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;id&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">, </span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;title&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">, </span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;content&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">, </span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;rate&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">, </span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;keywords&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">]);</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">                });</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">                $sheet</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">rows</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">($rows);</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">            });</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">        })</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">export</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">(</span><span style="--shiki-light:#032F62;--shiki-dark:#9ECBFF;">&#39;xls&#39;</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">);</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">    }</span></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">}</span></span></code></pre></div><p>然后在<code>model-table</code>中使用这个导出类：</p><div class="language-php vp-adaptive-theme"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki shiki-themes github-light github-dark vp-code" tabindex="0"><code><span class="line"><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">use</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> App\\Admin\\Extensions\\ExcelExpoter</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">;</span></span>
<span class="line"></span>
<span class="line"><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">$table</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">-&gt;</span><span style="--shiki-light:#6F42C1;--shiki-dark:#B392F0;">exporter</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">(</span><span style="--shiki-light:#D73A49;--shiki-dark:#F97583;">new</span><span style="--shiki-light:#005CC5;--shiki-dark:#79B8FF;"> ExcelExpoter</span><span style="--shiki-light:#24292E;--shiki-dark:#E1E4E8;">());</span></span></code></pre></div><p>有关更多<code>Laravel-Excel</code>的使用方法，参考<a href="http://www.maatwebsite.nl/laravel-excel/docs" target="_blank" rel="noreferrer">laravel-excel/docs</a></p>`,31),h=[l];function t(k,e,E,r,d,g){return a(),i("div",null,h)}const F=s(p,[["render",t]]);export{c as __pageData,F as default};
