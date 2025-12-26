<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo asset('admin') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo asset('admin') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo asset('admin') ?>/dist/css/adminlte.min.css?v=3.2.0">
<script defer="" referrerpolicy="origin" src="/cdn-cgi/zaraz/s.js?zJTd=JTdCJTIyZXhlY3V0ZWQlMjIlM0ElNUIlNUQlMkMlMjJ0JTIyJTNBJTIyQWRtaW5MVEUlMjAzJTIwDJTIwTG9nJTIwaW4lMjIlMkMlMjJ4JTIyJTNBMC44MjI4MTg2NjU5NjU1NDI1JTJDJTIydyUyMiUzQTE1MzYlMkMlMjJoJTIyJTNBNzM3JTJDJTIyaiUyMiUzQTczNSUyQyUyMmUlMjIlM0ExNTM2JTJDJTIybCUyMiUzQSUyMmh0dHBzJTNBJTJGJTJGYWRtaW5sdGUuaW8lMkZ0aGVtZXMlMkZ2MyUyRnBhZ2VzJTJGZXhhbXBsZXMlMkZsb2dpbi5odG1sJTIyJTJDJTIyciUyMiUzQSUyMmh0dHBzJTNBJTJGJTJGYWRtaW5sdGUuaW8lMkZ0aGVtZXMlMkZ2MyUyRmluZGV4Mi5odG1sJTIyJTJDJTIyayUyMiUzQTI0JTJDJTIybiUyMiUzQSUyMlVURi04JTIyJTJDJTIybyUyMiUzQTE4MCUyQyUyMnElMjIlM0ElNUIlNUQlN0Q="></script><script data-cfasync="false" nonce="b8827fa6-dbe8-44dc-996a-da1fcb5aeb44">try{(function(w,d){!function(j,k,l,m){if(j.zaraz)console.error("zaraz is loaded twice");else{j[l]=j[l]||{};j[l].executed=[];j.zaraz={deferred:[],listeners:[]};j.zaraz._v="5828";j.zaraz._n="b8827fa6-dbe8-44dc-996a-da1fcb5aeb44";j.zaraz.q=[];j.zaraz._f=function(n){return async function(){var o=Array.prototype.slice.call(arguments);j.zaraz.q.push({m:n,a:o})}};for(const p of["track","set","debug"])j.zaraz[p]=j.zaraz._f(p);j.zaraz.init=()=>{var q=k.getElementsByTagName(m)[0],r=k.createElement(m),s=k.getElementsByTagName("title")[0];s&&(j[l].t=k.getElementsByTagName("title")[0].text);j[l].x=Math.random();j[l].w=j.screen.width;j[l].h=j.screen.height;j[l].j=j.innerHeight;j[l].e=j.innerWidth;j[l].l=j.location.href;j[l].r=k.referrer;j[l].k=j.screen.colorDepth;j[l].n=k.characterSet;j[l].o=(new Date).getTimezoneOffset();if(j.dataLayer)for(const t of Object.entries(Object.entries(dataLayer).reduce(((u,v)=>({...u[1],...v[1]})),{})))zaraz.set(t[0],t[1],{scope:"page"});j[l].q=[];for(;j.zaraz.q.length;){const w=j.zaraz.q.shift();j[l].q.push(w)}r.defer=!0;for(const x of[localStorage,sessionStorage])Object.keys(x||{}).filter((z=>z.startsWith("_zaraz_"))).forEach((y=>{try{j[l]["z_"+y.slice(7)]=JSON.parse(x.getItem(y))}catch{j[l]["z_"+y.slice(7)]=x.getItem(y)}}));r.referrerPolicy="origin";r.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(j[l])));q.parentNode.insertBefore(r,q)};["complete","interactive"].includes(k.readyState)?zaraz.init():j.addEventListener("DOMContentLoaded",zaraz.init)}}(w,d,"zarazData","script");window.zaraz._p=async mY=>new Promise((mZ=>{if(mY){mY.e&&mY.e.forEach((m$=>{try{const na=d.querySelector("script[nonce]"),nb=na?.nonce||na?.getAttribute("nonce"),nc=d.createElement("script");nb&&(nc.nonce=nb);nc.innerHTML=m$;nc.onload=()=>{d.head.removeChild(nc)};d.head.appendChild(nc)}catch(nd){console.error(`Error executing script: ${m$}\n`,nd)}}));Promise.allSettled((mY.f||[]).map((ne=>fetch(ne[0],ne[1]))))}mZ()}));zaraz._p({"e":["(function(w,d){})(window,document)"]});})(window,document)}catch(e){throw fetch("/cdn-cgi/zaraz/t"),e;};</script><script>(function(w,d){})(window,document)</script><script>(function(w,d){;w.zarazData.executed.push("Pageview");})(window,document)</script><script>(function(w,d){})(window,document)</script></head>
<body class="login-page" style="min-height: 495.6px;">
<div class="login-box">
  <div class="login-logo">
    <a>CONSULTORIO CLINICO</a>
  </div>
  <!--login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicio de session</p>

      <form id="registro" method="POST" action="{{ route('login.auth') }}">
    @csrf
    <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" class="form-control" name="email" placeholder="Email" required>
    </div>
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Login</button>
    <a href="/registro" class="btn btn-secondary btn-block">Registro</a>  
</form>

  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo asset('admin') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo asset('admin') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo asset('admin') ?>/dist/js/adminlte.min.js?v=3.2.0"></script>


</body>
</html>