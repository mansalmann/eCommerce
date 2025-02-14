<script>
     
    let resolver = null;
    window.googleRecaptchaResponse = new Promise((resolve) => resolver = resolve);

    window.googleRecaptchaOnloadCallback = function () {
        grecaptcha.render('g-recaptcha-element', {
            sitekey: "6LevC9YqAAAAAKgzD7UPjfwXd0P5siiSKAnQMMrx",
            theme: "light",
            size: "normal",
            callback: resolver,
        });
    };


    document.addEventListener('livewire:init', () => {
        Livewire.hook('morph.updated', ({ el, component }) => {
            return false;
        });

        Livewire.directive('recaptcha', ({ el, directive, component, cleanup }) => {
            const submitExpression = (() => {
                for (const attr of el.attributes) {
                    if (attr.name.startsWith('wire:submit')) {
                        return attr.value;
                    }
                }
            })();

            const onSubmit = async (e) => {
                e.preventDefault();
                e.stopImmediatePropagation();

                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                const token = await window.googleRecaptchaResponse;

                await component.$wire.$set('gRecaptchaResponse', token);

                Alpine.evaluate(el, "$wire." + submitExpression, { scope: { $event: e } });
            }

            el.addEventListener('submit', onSubmit, { capture: true });
        });
    });
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=googleRecaptchaOnloadCallback&amp;render=explicit" async="" defer=""></script>