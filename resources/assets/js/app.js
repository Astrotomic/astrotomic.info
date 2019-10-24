(function () {
    document.querySelectorAll('[data-count-up]').forEach($countUp => {
        const target = $countUp.dataset.countUp;
        const duration = 1500;
        const timeout = 25;
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
})();