if('serviceWorker' in navigator){
    navigator.serviceWorker.register('https://monggoman.github.io/SPE.github.io/sw.js')
        .then((reg) => console.log('server worker registered'))
        .catch((err) => console.log('service worker not registered'))
}