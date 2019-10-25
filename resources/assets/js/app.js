(function () {
    document.querySelectorAll('[data-count-up]').forEach($countUp => {
        const target = $countUp.dataset.countUp;
        const duration = 1000;
        const timeout = 20;
        const runs = Math.round(duration / timeout);

        let cycles = 0;
        const interval = setInterval(() => {
            $countUp.innerText = Math.floor((target / runs) * cycles);

            if (cycles++ === (runs + 1)) {
                $countUp.innerText = target;
                clearInterval(interval);
            }
        }, timeout);
    });

    window.addEventListener('scroll', function() {
        Object.assign(
            document.querySelector('header.hero').style,
            {
                backgroundPositionY: -(window.innerHeight * 0.5) + (window.pageYOffset * 0.5) + 'px',
                backgroundPositionX: -(window.pageYOffset * 0.5) + 'px',
            }
        );
    });
})();
