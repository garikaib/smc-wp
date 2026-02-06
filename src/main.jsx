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

// Mount Events Calendar
import EventsCalendar from './EventsCalendar.jsx';
const eventsRoot = document.getElementById('smc-events-root');
if (eventsRoot) {
    const root = ReactDOM.createRoot(eventsRoot);
    root.render(
        <React.StrictMode>
            <EventsCalendar />
        </React.StrictMode>
    );
}
// Mount User Profile SPA
import UserProfile from './UserProfile.jsx';
import './UserProfile.css';
const profileRoot = document.getElementById('smc-profile-spa-root');
if (profileRoot) {
    ReactDOM.createRoot(profileRoot).render(
        <React.StrictMode>
            <UserProfile />
        </React.StrictMode>
    );
}
