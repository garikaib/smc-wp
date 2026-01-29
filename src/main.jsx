import React from 'react';
import ReactDOM from 'react-dom/client';
import HeroSlider from './HeroSlider.jsx';
import ClientTicker from './ClientTicker.jsx';
import './HeroSlider.css';
import './ClientTicker.css';

// Mount Hero Slider
const sliderRoot = document.getElementById('smc-react-slider-root');
if (sliderRoot) {
    ReactDOM.createRoot(sliderRoot).render(
        <React.StrictMode>
            <HeroSlider />
        </React.StrictMode>
    );
}

// Mount Client Ticker
const tickerRoot = document.getElementById('smc-react-ticker-root');
if (tickerRoot) {
    ReactDOM.createRoot(tickerRoot).render(
        <React.StrictMode>
            <ClientTicker />
        </React.StrictMode>
    );
}
