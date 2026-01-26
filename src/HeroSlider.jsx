import React, { useState, useEffect } from 'react';

const HeroSlider = () => {
    const [activeIndex, setActiveIndex] = useState(0);
    const [exitIndex, setExitIndex] = useState(null);

    // Use dynamic data if available, otherwise fallback to static for development
    const slides = (window.smcHeroData && window.smcHeroData.length > 0)
        ? window.smcHeroData
        : [
            {
                id: 1,
                text: "Drive business impact",
                icon: "🚀",
                image: "/wp-content/uploads/2026/01/home_slider1.webp"
            },
            {
                id: 2,
                text: "Engage top talent",
                icon: "👥",
                image: "/wp-content/uploads/2026/01/home_slider2.webp"
            },
            {
                id: 3,
                text: "Thrive in change",
                icon: "📈",
                image: "/wp-content/uploads/2026/01/home_slider3.webp"
            }
        ];

    useEffect(() => {
        const interval = setInterval(() => {
            setExitIndex(activeIndex);
            setActiveIndex((current) => (current + 1) % slides.length);
        }, 5000);
        return () => clearInterval(interval);
    }, [activeIndex, slides.length]);

    const getImageClass = (index) => {
        if (index === activeIndex) return 'active';
        if (index === exitIndex) return 'exit';
        return '';
    };

    return (
        <div className="smc-react-slider">
            <div className="smc-orb-container">
                <div className="smc-orb"></div>
            </div>
            <div className="smc-slider-layout">
                {/* Left/Center: Text Carousel */}
                <div className="smc-text-column">
                    <div className="smc-text-list">
                        {slides.map((slide, index) => (
                            <div
                                key={slide.id}
                                className={`smc-text-item ${index === activeIndex ? 'active' : ''}`}
                                onClick={() => {
                                    setExitIndex(activeIndex);
                                    setActiveIndex(index);
                                }}
                            >
                                <span className="smc-text-icon">{slide.icon}</span>
                                <span className="smc-text-label">{slide.text}</span>
                            </div>
                        ))}
                    </div>
                </div>

                {/* Right: Image Slider */}
                <div className="smc-image-column">
                    {slides.map((slide, index) => (
                        <div
                            key={slide.id}
                            className={`smc-image-item ${getImageClass(index)}`}
                            style={{
                                zIndex: index === activeIndex ? 10 : (index === exitIndex ? 9 : 0)
                            }}
                        >
                            <img src={slide.image} alt={slide.text} />
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
};

export default HeroSlider;
