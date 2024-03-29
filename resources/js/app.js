import.meta.glob([
    '../img/**',
]);

(function () {
    document.querySelectorAll('[data-count-up]').forEach($countUp => {
        const target = $countUp.dataset.countUp * 1;
        const duration = 1000;
        const timeout = 20;
        const runs = Math.round(duration / timeout);

        let cycles = 0;
        const interval = setInterval(() => {
            $countUp.innerText = Math.floor((target / runs) * cycles).toLocaleString('en').replaceAll(',', ' ');

            if (cycles++ === (runs + 1)) {
                $countUp.innerText = target.toLocaleString('en').replaceAll(',', ' ');
                clearInterval(interval);
            }
        }, timeout);
    });

    window.addEventListener('scroll', function() {
        document.querySelectorAll('header.hero .comets[data-speed]').forEach($comet => {
            Object.assign(
                $comet.style,
                {
                    backgroundPositionY: -(window.innerHeight * 0.5) + (window.pageYOffset * $comet.dataset.speed) + 'px',
                    backgroundPositionX: -(window.pageYOffset * $comet.dataset.speed) + 'px',
                }
            );
        });
    });
})();
