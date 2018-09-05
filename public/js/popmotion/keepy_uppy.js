var _window$popmotion = window.popmotion,
    easing = _window$popmotion.easing,
    physics = _window$popmotion.physics,
    spring = _window$popmotion.spring,
    tween = _window$popmotion.tween,
    styler = _window$popmotion.styler,
    listen = _window$popmotion.listen,
    value = _window$popmotion.value,
    transform = _window$popmotion.transform;
var pipe = transform.pipe,
    clampMax = transform.clampMax;


var ball = document.querySelector('.ball');
var ball_text = document.querySelector('.ball h3');
var ballStyler = styler(ball);
var ballY = value(0, function (v) {
    return ballStyler.set('y', Math.min(0, v));
});
var ballScale = value(1, function (v) {
    ballStyler.set('scaleX', 1 + (1 - v));
    ballStyler.set('scaleY', v);
});
var count = 0;
var isFalling = false;

var ballBorder = value({
    borderColor: '',
    borderWidth: 0
}, function (_ref) {
    var borderColor = _ref.borderColor,
        borderWidth = _ref.borderWidth;
    return ballStyler.set({
        boxShadow: '0 0 0 ' + borderWidth + 'px ' + borderColor
    });
});

var checkBounce = function checkBounce() {
    if (!isFalling || ballY.get() < 0) return;

    isFalling = false;
    var impactVelocity = ballY.getVelocity();
    var compression = spring({
        to: 1,
        from: 1,
        velocity: -impactVelocity * 0.01,
        stiffness: 800
    }).pipe(function (s) {
        if (s >= 1) {
            s = 1;
            compression.stop();

            if (impactVelocity > 20) {
                isFalling = true;
                gravity.set(0).setVelocity(-impactVelocity * 0.5);
            }
        }
        return s;
    }).start(ballScale);
};

var checkFail = function checkFail() {
    if (ballY.get() >= 0 && ballY.getVelocity() !== 0 && ball.innerHTML !== '&#9757;') {
        count = 0;
        tween({
            from: { borderWidth: 0, borderColor: 'rgb(0, 255, 255, 1)' },
            to: { borderWidth: 30, borderColor: 'rgb(0, 255, 255, 0)' }
        }).start(ballBorder);

        ball_text.innerHTML = '&#9757;';
    }
};

var gravity = physics({
    acceleration: 2500,
    restSpeed: false
}).start(function (v) {
    ballY.update(v);
    checkBounce(v);
    checkFail(v);
});

listen(ball, 'mousedown touchstart').start(function (e) {
    e.preventDefault();
    count++;
    $.vue_app.$data.highscore = count > $.vue_app.$data.highscore ? count : $.vue_app.$data.highscore;
    ball_text.innerHTML = count;

    isFalling = true;
    ballScale.stop();
    ballScale.update(1);

    gravity.set(Math.min(0, ballY.get())).setVelocity(-(300 * count + 800));

    tween({
        from: { borderWidth: 0, borderColor: 'rgb(0, 255, 255, 1)' },
        to: { borderWidth: 30, borderColor: 'rgb(0, 255, 255, 0)' }
    }).start(ballBorder);
});
