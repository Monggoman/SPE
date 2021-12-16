const staticCacheName = "site-static-v1";
const dynamicCache = "dynamic-v2";
const assets = [
    'https://monggoman.github.io/SPE.github.io/',
    'https://monggoman.github.io/SPE.github.io/index.html',
    'https://monggoman.github.io/SPE.github.io/js/app.js',
    'https://monggoman.github.io/SPE.github.io/js/materialize.min.js',
    'https://monggoman.github.io/SPE.github.io/js/ui.js',
    'https://monggoman.github.io/SPE.github.io/css/style.css',
    'https://monggoman.github.io/SPE.github.io/css/materialize.min.css',
    'https://monggoman.github.io/SPE.github.io/img/logo1.png',
    'https://fonts.googleapis.com/icon?family=Material+Icons',
];

//install service worker
self.addEventListener('install', evt=>{
    //console.log('service worker has been installed');
    evt.waitUntil(
    caches.open(staticCacheName).then(cache =>{
        console.log('caching shell assets')
        cache.addAll(assets)
    }));
});

// activate event
self.addEventListener('activate', evt =>{
    //console.log('service worker has been activated');
    evt.waitUntil(
        caches.keys().then(keys =>{
            //console.log(keys);
            return Promise.all(keys
                    .filter(key => key !== staticCacheName)
                    .map (key => caches.delete(key))
                )
        })
    );
});

//fetch event
self.addEventListener('fetch', evt =>{
    //console.log('fetch event', evt);
    evt.respondWith(
        caches.match(evt.request).then(cacheRes =>{
            return cacheRes || fetch(evt.request).then(fetchRes =>{
                return caches.open(dynamicCache).then(cache =>{
                    cache.put(evt.request.url, fetchRes.clone());
                    return fetchRes;
                })
            })
        })
    );
});

