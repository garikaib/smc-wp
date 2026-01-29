import React from 'react';
import './ClientTicker.css';

const ClientTicker = () => {
    // Use dynamic data if available
    const logos = (window.smcClientLogos && window.smcClientLogos.length > 0)
        ? window.smcClientLogos
        : [];

    if (logos.length === 0) return null;

    // Duplicate logos to ensure seamless scrolling
    const displayLogos = [...logos, ...logos, ...logos, ...logos];

    return (
        <div className="smc-logo-ticker-section">
            <h3 className="smc-ticker-headline">For over 27 years, we've coached leaders at world-class brands</h3>
            <div className="smc-logo-ticker-container">
                <div className="smc-logo-track">
                    {displayLogos.map((logo, index) => (
                        <div key={`${logo.id}-${index}`} className="smc-logo-item">
                            <img src={logo.image} alt={logo.title} title={logo.title} />
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
};

export default ClientTicker;
