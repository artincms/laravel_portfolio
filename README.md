# laravel_gallery_system
laravel Portfolio manager is a laravel package 

# Requiments 
<ul>
<li>
PHP >= 7.0
</li>
<li>
Laravel 5.5|5.6
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
for windows
 <div class="highlight highlight-text-html-php"><pre>
  php artisan db:seed --class=ArtinCMS\LFM\Database\Seeds\FilemanagerTableSeeder
  </pre> </div>
  for linux
  <div class="highlight highlight-text-html-php"><pre>
 php artisan db:seed --class=ArtinCMS\\LFM\\Database\\Seeds\\FilemanagerTableSeeder
  </pre> </div>
for more learn about laravel file manager setup you can visit <a href="https://github.com/artincms/laravel_file_manager">laravel file manager </a>
  
   <h1>usage</h1> 
  
for use portfolio manager
backend url is : 
 <div class="highlight highlight-text-html-php">
 <pre>
 http://yourDomain/LPM/Portfolio
  </pre> 
  </div>
  
for use laravel portfolio in frontend of site you should 
encode below html code in your project :

```
   <div id="portfolio">
        <laravel_portfolio :category_id="1" :lang_id=1 :rtl=true></laravel_portfolio>
    </div>
```
and load this javascript file 
```angular2html
    <script src="{{ asset('vendor/laravel_portfolio/components/portfolio.min.js') }}" defer></script>
```