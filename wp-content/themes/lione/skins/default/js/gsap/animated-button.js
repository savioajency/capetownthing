class SNClass {
    constructor() {
        this.bind()
        this.callbacks = []
        this.dt = 0.15
        this.lastF = Date.now()
        this.render()
    }

    subscribe(name, callback) {
        this.callbacks.push({
            name: name,
            callback: callback
        })
    }

    unsubscribe(name) {
        this.callbacks.forEach((item, i) => {
            if (item.name == name)
                this.callbacks.splice(i, i + 1)
        });
    }

    render() {
        requestAnimationFrame(this.render)
        this.callbacks.forEach(item => {
            item.callback()
        });

        this.dt = Date.now() - this.lastF
        this.lastF = Date.now()
    }

    bind() {
        this.subscribe = this.subscribe.bind(this)
        this.unsubscribe = this.unsubscribe.bind(this)
        this.render = this.render.bind(this)
    }
}

let SN = new SNClass()

if (jQuery( '.sc_button_animated' ).length > 0) {
    let $sc_buttons = jQuery('.sc_button_animated');
    $sc_buttons.each(function (idx) {
        let sc_button = $sc_buttons.eq(idx);
        let sc_button_color = sc_button.css( 'color' );

        let r = new SimplexNoise();

        //Current instance of the animated button
        let i = {
            strokeSize: 81,
            strokeMargin: 90,
            strokePosition: {x: 0, y: 0},
            circleNumber: 2,
            noiseAmplitude: 7,
            noiseDetail: 0.5,
            noiseSpeed: 0.001,
            buttonAlpha: 1
        };

        (i.strokePosition.x = i.strokeMargin),
            (i.strokePosition.y = i.strokeMargin);

        //converting our instance into JavaScript Object (keys are put inside quotes)
        let a = JSON.parse(JSON.stringify(i)); //Currently of no use

        //Creating canvas
        let canvas = sc_button.find('canvas');
        let ctx = canvas.get(0).getContext("2d");

        let c = (ctx.canvas.width = 180),
            v = (ctx.canvas.height = 180),
            L = {value: 1};

        window.isMobile ||
        sc_button.mousemove(function () {
            TweenLite.to(L, 0.5, {value: 0})
        }),
        sc_button.mouseleave(function () {
            TweenLite.to(L, 0.5, {value: 1})
        }),

        SN.subscribe("strokeUpdate", function () {
            //Drawing on canvas takes place
            ctx.clearRect(0, 0, c, v),
            (ctx.lineWidth = 1),
            (function () {
                for (let t = 0; t < i.circleNumber; t++) {
                    ctx.beginPath();
                    for (let a = 0; a < 2 * Math.PI; a += (2 * Math.PI) / 50) {
                        let n = Math.cos(a),
                            u = Math.sin(a);
                        let e = r.noise3D(n * i.noiseDetail, u * i.noiseDetail, Date.now() * i.noiseSpeed + t);
                        let o = i.strokeSize + e * i.noiseAmplitude * L.value;
                        (n = n * o + i.strokePosition.x), (u = u * o + i.strokePosition.y), 0 == a ? ctx.moveTo(n, u) : ctx.lineTo(n, u);
                    }
                    let a = 1;
                    0 == t && (a = 0.6), (ctx.strokeStyle = sc_button_color), ctx.closePath(), ctx.stroke();
                }
            })();
        });
    });
}