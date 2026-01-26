import React from 'react';
import ReactDOM from 'react-dom/client';
import HeroSlider from './HeroSlider.jsx';
import './HeroSlider.css';

const rootElement = document.getElementById('smc-react-slider-root');

if (rootElement) {
    ReactDOM.createRoot(rootElement).render(
        <React.StrictMode>
            <HeroSlider />
        </React.StrictMode>
    );
}
