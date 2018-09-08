# laravel_portfolio manager
laravel Portfolio manager is a laravel package 

# Requiments 
<ul>
<li>
PHP >= 7.0
</li>
<li>
Laravel 5.5|5.6
</li>
<li>
vue js (if you want use our vue js template)
</li>
</ul>

# Installation
<h3>Quick installation</h3> 
<div class="highlight highlight-source-shell"><pre>composer require artincms/laravel_portfolio</pre></div>
<h6>publish vendor</h6>
 <div class="highlight highlight-text-html-php"><pre>
 $ php artisan vendor:publish --provider="ArtinCMS\LPM\LPMServiceProvider" --force
</pre> </div>
 <h6>migrate tabales</h6>
  <div class="highlight highlight-text-html-php"><pre>
   $ php artisan migrate
   </pre> </div>
<h6>seed larave file manager data to lfm_file_mime_type table</h6>
 <div class="highlight highlight-text-html-php"><pre>
  php artisan db:seed --class="ArtinCMS\LFM\Database\Seeds\FilemanagerTableSeeder"
  </pre> </div>
for more learn about laravel file manager setup you can visit <a href="https://github.com/artincms/laravel_file_manager">laravel file manager </a>

   <h1>usage</h1> 
for Manage portfolio manager
backend url is : 
 <div class="highlight highlight-text-html-php">
 <pre>
 http://yourDomain/LPM/Portfolio
  </pre> 
  </div>
  
for use laravel portfolio in frontend of site you should use
encode below html code in your project :

```
   <div id="portfolio">
        <laravel_portfolio :category_id="1" :lang_id=1 :rtl=true></laravel_portfolio>
    </div>
```
and create javascript file as sample bellow .

```
window.Vue = require('vue');
Vue.component('laravel_portfolio', require('./components/laravel_portfolio/laravel_portfolio.vue'));
window.onload = function () {
    const portfolio = new Vue({
        el: '#portfolio',
    });
}
``` 
if you dont want devlope this template you can just load this javascript file 
```angular2html
    <script src="{{ asset('vendor/laravel_portfolio/components/portfolio.min.js') }}" defer></script>
```

<h2><a id="user-content-props" class="anchor" aria-hidden="true" href="#props"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Props</h2>
<table>
<thead>
<tr>
<th>Props</th>
<th align="left">Type</th>
<th>Default</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
    <td>gallery_id</td>
    <td align="left">Number</td>
    <td>0</td>
    <td>gallery you want show if you set it to 0 show all gallery in main root</td>
</tr>
<tr>
    <td>lang_id</td>
    <td align="left">Number</td>
    <td>null</td>
    <td>The language item if set to null select all language</td>
</tr>
<tr>
    <td>rtl</td>
    <td align="left">Boolean</td>
    <td>true</td>
    <td>the direction of page rtl set true and ltr set to false</td>
</tr></tbody></table>

<h3>Other my Vue JS plugins</h3>
<table>
<thead>
<tr>
<th>Project</th>
<th>Description</th>
<th>npm install</th>
</tr>
</thead>
<tbody>
<td><a href="https://www.npmjs.com/package/axios" rel="nofollow">axios</a></td>
<td>Promise based HTTP client for the browser and node.js</td>
<td>npm install axios</td>
</tr>
<tr>
<td><a href="https://www.npmjs.com/package/vue-translate-plugin" rel="nofollow">Vue Translate Plugin</a></td>
<td>A VueJS (1.x, 2.0+) plugin for basic translations.</td>
<td>npm i vue-translate-plugin</td>
</tr>
</tbody>
</table>