window.onload = () => {
    gsap.registerPlugin(ScrollTrigger, MotionPathPlugin);
    gsap.to(".theLine", {
        scrollTrigger: {
            trigger: ".mission",
            start: "top top",
            end: "bottom+=40% top",
            scrub: 1,
        },
        strokeDashoffset: 0,
    });
    ScrollTrigger.create({
        trigger: ".mission",
        start: "top start",
        end: "bottom bottom",
        pin: ".star-wrapper",
        onEnter: () =>
            document.querySelector(".star-wrapper").classList.add("star-fixed"),
        onLeave: () =>
            document
                .querySelector(".star-wrapper")
                .classList.remove("star-fixed"),
        onEnterBack: () =>
            document.querySelector(".star-wrapper").classList.add("star-fixed"),
        onLeaveBack: () =>
            document
                .querySelector(".star-wrapper")
                .classList.remove("star-fixed"),
    });
    const swiper = new Swiper(".swiper-container", {
        loop: true,
        freeMode: true,
        freeModeMomentum: false,
        grabCursor: true,
        slidesPerView: "auto",
        // spaceBetween: 30,
        speed: 5000,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
            reverseDirection: false,
            pauseOnMouseEnter: true,
        },
    });

    // To avoid jitter after dragging on desktop, re-enable autoplay manually after short delay
    let autoplayRestoreTimeout;

    swiper.el.addEventListener("mousedown", () => {
        swiper.autoplay.stop();
        clearTimeout(autoplayRestoreTimeout);
    });

    swiper.el.addEventListener("mouseup", () => {
        autoplayRestoreTimeout = setTimeout(() => {
            swiper.autoplay.start();
        }, 500); // restart autoplay shortly after releasing mouse
    });

    // Also works for mobile drag
    swiper.el.addEventListener("touchstart", () => {
        swiper.autoplay.stop();
        clearTimeout(autoplayRestoreTimeout);
    });

    swiper.el.addEventListener("touchend", () => {
        autoplayRestoreTimeout = setTimeout(() => {
            swiper.autoplay.start();
        }, 500);
    });

    // const friction = -0.9;

    // const ball = document.querySelector(".ball");
    // const ballProps = gsap.getProperty(ball);
    // const radius = ball.getBoundingClientRect().width / 2;
    // const tracker = InertiaPlugin.track(ball, "x,y")[0];

    // const container = document.querySelector(".cta");
    // let vw = container.clientWidth;
    // let vh = container.clientHeight;

    // gsap.defaults({
    //     overwrite: true,
    // });

    // gsap.set(ball, {
    //     xPercent: -50,
    //     yPercent: -50,
    //     x: vw / 2,
    //     y: vh / 2,
    // });

    // const draggable = new Draggable(ball, {
    //     bounds: container, // ← bounds are now the CTA area
    //     onPress() {
    //         gsap.killTweensOf(ball);
    //         this.update();
    //     },
    //     onDragEnd: animateBounce,
    //     onDragEndParams: []
    // });

    // window.addEventListener("resize", () => {
    //     vw = container.clientWidth;
    //     vh = container.clientHeight;
    // });

    // function animateBounce(x = "+=0", y = "+=0", vx = "auto", vy = "auto") {
    //     gsap.fromTo(
    //         ball,
    //         { x, y },
    //         {
    //             inertia: {
    //                 x: vx,
    //                 y: vy,
    //             },
    //             onUpdate: checkBounds,
    //         }
    //     );
    // }

    // function checkBounds() {
    //     let r = radius;
    //     let x = ballProps("x");
    //     let y = ballProps("y");
    //     let vx = tracker.get("x");
    //     let vy = tracker.get("y");
    //     let xPos = x;
    //     let yPos = y;

    //     let hitting = false;

    //     if (x + r > vw) {
    //         xPos = vw - r;
    //         vx *= friction;
    //         hitting = true;
    //     } else if (x - r < 0) {
    //         xPos = r;
    //         vx *= friction;
    //         hitting = true;
    //     }

    //     if (y + r > vh) {
    //         yPos = vh - r;
    //         vy *= friction;
    //         hitting = true;
    //     } else if (y - r < 0) {
    //         yPos = r;
    //         vy *= friction;
    //         hitting = true;
    //     }

    //     if (hitting) {
    //         animateBounce(xPos, yPos, vx, vy);
    //     }
    // }

    // window.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(InertiaPlugin);

    let oldX = 0,
        oldY = 0,
        deltaX = 0,
        deltaY = 0;

    const root = document.querySelector(".cta");
    root.addEventListener("mousemove", (e) => {
        // Calculate horizontal movement since the last mouse position
        deltaX = e.clientX - oldX;

        // Calculate vertical movement since the last mouse position
        deltaY = e.clientY - oldY;

        // Update old coordinates with the current mouse position
        oldX = e.clientX;
        oldY = e.clientY;
    });

    root.querySelectorAll(".media").forEach((el) => {
        // Add an event listener for when the mouse enters each media
        el.addEventListener("mouseenter", () => {
            const tl = gsap.timeline({
                onComplete: () => {
                    tl.kill();
                },
            });
            tl.timeScale(0.5); // Animation will play -50% faster than normal

            const image = el.querySelector("img");
            tl.to(image, {
                inertia: {
                    x: {
                        velocity: deltaX * 10, // Higher number = movement amplified
                        end: 0, // Go back to the initial position
                    },
                    y: {
                        velocity: deltaY * 10, // Higher number = movement amplified
                        end: 0, // Go back to the initial position
                    },
                },
            });
            tl.fromTo(
                image,
                {
                    rotate: 0,
                },
                {
                    duration: 0.4,
                    rotate: (Math.random() - 0.5) * 30, // Returns a value between -15 & 15
                    yoyo: true,
                    repeat: 1,
                    ease: "power1.inOut", // Will slow at the begin and the end
                },
                "<"
            ); // The animation starts at the same time as the previous tween
        });
    });
    // });
};
