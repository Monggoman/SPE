const staticCacheName = "site-static-v16";
const dynamicCache = "dynamic-v16";
const assets = [
    '/student eval/',
    '/student eval/index.php',
    '/student eval/js/app.js',
    '/student eval/js/materialize.min.js',
    '/student eval/js/ui.js',
    '/student eval/css/style.css',
    '/student eval/css/materialize.min.css',
    '/student eval/img/logo1.png',
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
		if (!(evt.request.url.indexOf('http') === 0)) return; // skip the request. if request is not made with http protocol

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

