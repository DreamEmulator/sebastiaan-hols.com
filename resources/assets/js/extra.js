//Auto-Dark mode
// async function lookOutside() {
//     const location = await (await fetch('https://ipapi.co/json/')).json();
//     const time = await (await fetch(`https://api.sunrise-sunset.org/json?lat=${location.latitude}&lng=${location.longitude}&formatted=0`)).json();
//
//     return await new Date().toUTCString() > Date.parse(time.results.sunrise) && new Date().toUTCString() < Date.parse(time.results.sunset);
// }
//
// lookOutside().then(lightOutside => {
//     if (!lightOutside && document.querySelector("meta[name=daylight]").getAttribute("content").length == 0){
//         document.getElementById('change_dream_theme').submit();
//     }
// });


//Click to discover
window.onload = () => {

    let cards = Array.from(document.getElementsByClassName('card')),
        top = cards[0].getBoundingClientRect().top + window.scrollY;

    document.getElementById('click-discover').addEventListener('click', () => {

        //Scroll to first card
        window.scroll({
            top: top, behavior: 'smooth'
        });

    });

//Emphasize hovered card
    cards.forEach((item, index) => {

        let baseIndex = index;

        item.addEventListener('mouseenter', () => {

            cards.forEach((item, index) => {

                if (index !== baseIndex) {
                    item.style = "filter: blur(2px); transition: 1s;";
                } else {
                    item.style = "transform: scale(1.025); transition: 1s;";
                    item.children[0].style = "filter: saturate(1.15); transition: 1s;";
                }

                setTimeout(() => {
                    item.style = "transform: scale(1); filter: blur(0px) saturate(1); transition: 1s;";
                }, 3000);

            });

        });

    });
};