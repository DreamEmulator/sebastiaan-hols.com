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

                setTimeout(()=>{
                    item.style = "transform: scale(1); filter: blur(0px) saturate(1); transition: 1s;";
                },3000);

            });

        });

    });

};