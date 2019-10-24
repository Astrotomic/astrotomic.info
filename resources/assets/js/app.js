(function () {
    document.querySelectorAll('[data-count-up]').forEach($countUp => {
        const target = $countUp.dataset.countUp;
        const duration = 2000;
        const timeout = 20;
        const runs = Math.round(duration / timeout);
        let cycles = 0;

        const interval = setInterval(() => {
            $countUp.innerText = Math.floor((target / runs) * cycles);

            cycles++;
            if (cycles === (runs + 1)) {
                $countUp.innerText = target;
                clearInterval(interval);
            }
        }, timeout);
    });
})();