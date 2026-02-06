import React, { useState, useEffect } from 'react';
import { User, Mail, Shield, Check, AlertCircle, Loader2, Lock, Key } from 'lucide-react';
import gsap from 'gsap';

const UserProfile = () => {
    const [activeTab, setActiveTab] = useState('profile');
    const [profile, setProfile] = useState({
        first_name: '',
        last_name: '',
        display_name: '',
        email: ''
    });
    const [security, setSecurity] = useState({
        current_password: '',
        new_password: '',
        confirm_password: ''
    });

    const [loading, setLoading] = useState(true);
    const [saving, setSaving] = useState(false);
    const [message, setMessage] = useState({ type: '', text: '' });

    useEffect(() => {
        fetch('/wp-json/smc/v1/profile', {
            headers: {
                'X-WP-Nonce': wpApiSettings.nonce
            }
        })
            .then(res => res.json())
            .then(data => {
                setProfile(data);
                setLoading(false);
                animateEntry('.smc-profile-form > *');
            })
            .catch(err => {
                console.error('Error fetching profile:', err);
                setLoading(false);
            });
    }, []);

    const animateEntry = (selector) => {
        gsap.fromTo(selector,
            { y: 20, opacity: 0 },
            { y: 0, opacity: 1, stagger: 0.1, ease: "power4.out", duration: 0.8 }
        );
    };

    const handleTabChange = (tab) => {
        if (tab === activeTab) return;

        const currentForm = document.querySelector('.smc-profile-form');
        gsap.to(currentForm, {
            opacity: 0, y: 10, duration: 0.3, onComplete: () => {
                setActiveTab(tab);
                setMessage({ type: '', text: '' });
                gsap.fromTo(currentForm, { opacity: 0, y: 10 }, { opacity: 1, y: 0, duration: 0.4 });
                animateEntry('.smc-profile-form > *');
            }
        });
    };

    const handleProfileChange = (e) => {
        setProfile({ ...profile, [e.target.name]: e.target.value });
    };

    const handleSecurityChange = (e) => {
        setSecurity({ ...security, [e.target.name]: e.target.value });
    };

    const handleProfileSubmit = (e) => {
        e.preventDefault();
        setSaving(true);
        setMessage({ type: '', text: '' });

        fetch('/wp-json/smc/v1/profile', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': wpApiSettings.nonce
            },
            body: JSON.stringify(profile)
        })
            .then(res => res.json())
            .then(data => {
                setSaving(false);
                if (data.message) {
                    setMessage({ type: 'success', text: data.message });
                } else if (data.message) {
                    setMessage({ type: 'error', text: data.message });
                }
            })
            .catch(err => {
                setSaving(false);
                setMessage({ type: 'error', text: 'An error occurred while saving profile.' });
            });
    };

    const handleSecuritySubmit = (e) => {
        e.preventDefault();

        if (security.new_password !== security.confirm_password) {
            setMessage({ type: 'error', text: 'New passwords do not match.' });
            return;
        }

        setSaving(true);
        setMessage({ type: '', text: '' });

        fetch('/wp-json/smc/v1/profile/password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': wpApiSettings.nonce
            },
            body: JSON.stringify({
                current_password: security.current_password,
                new_password: security.new_password
            })
        })
            .then(res => res.json())
            .then(data => {
                setSaving(false);
                if (data.code || data.message === undefined) {
                    setMessage({ type: 'error', text: data.message || 'Verification failed.' });
                } else {
                    setMessage({ type: 'success', text: data.message });
                    setSecurity({ current_password: '', new_password: '', confirm_password: '' });
                }
            })
            .catch(err => {
                setSaving(false);
                setMessage({ type: 'error', text: 'An error occurred while updating password.' });
            });
    };

    if (loading) {
        return (
            <div className="smc-spa-loading">
                <Loader2 className="animate-spin" size={40} />
                <p>Loading Workspace...</p>
            </div>
        );
    }

    return (
        <div className="smc-profile-container">
            <div className="smc-profile-header">
                <h2 className="smc-auth-title">Refine Your Identity</h2>
                <p className="smc-auth-subtitle">Update your personal information and security settings.</p>
            </div>

            <div className="smc-spa-tabs">
                <button
                    className={`smc-spa-tab ${activeTab === 'profile' ? 'active' : ''}`}
                    onClick={() => handleTabChange('profile')}
                >
                    Profile
                </button>
                <button
                    className={`smc-spa-tab ${activeTab === 'security' ? 'active' : ''}`}
                    onClick={() => handleTabChange('security')}
                >
                    Security
                </button>
            </div>

            <form className="smc-profile-form smc-auth-form" onSubmit={activeTab === 'profile' ? handleProfileSubmit : handleSecuritySubmit}>
                {activeTab === 'profile' ? (
                    <>
                        <div className="smc-form-grid">
                            <div className="smc-form-group">
                                <label>FIRST NAME</label>
                                <div className="input-wrapper">
                                    <User size={18} />
                                    <input
                                        type="text"
                                        name="first_name"
                                        value={profile.first_name}
                                        onChange={handleProfileChange}
                                        className="form-control"
                                        placeholder="Your first name"
                                    />
                                </div>
                            </div>

                            <div className="smc-form-group">
                                <label>LAST NAME</label>
                                <div className="input-wrapper">
                                    <User size={18} />
                                    <input
                                        type="text"
                                        name="last_name"
                                        value={profile.last_name}
                                        onChange={handleProfileChange}
                                        className="form-control"
                                        placeholder="Your last name"
                                    />
                                </div>
                            </div>
                        </div>

                        <div className="smc-form-group">
                            <label>DISPLAY NAME</label>
                            <div className="input-wrapper">
                                <Shield size={18} />
                                <input
                                    type="text"
                                    name="display_name"
                                    value={profile.display_name}
                                    onChange={handleProfileChange}
                                    className="form-control"
                                    placeholder="How should we address you?"
                                    required
                                />
                            </div>
                        </div>

                        <div className="smc-form-group">
                            <label>EMAIL ADDRESS</label>
                            <div className="input-wrapper">
                                <Mail size={18} />
                                <input
                                    type="email"
                                    name="email"
                                    value={profile.email}
                                    onChange={handleProfileChange}
                                    className="form-control"
                                    placeholder="john@example.com"
                                    required
                                />
                            </div>
                        </div>
                    </>
                ) : (
                    <>
                        <div className="smc-form-group">
                            <label>CURRENT PASSWORD</label>
                            <div className="input-wrapper">
                                <Key size={18} />
                                <input
                                    type="password"
                                    name="current_password"
                                    value={security.current_password}
                                    onChange={handleSecurityChange}
                                    className="form-control"
                                    placeholder="••••••••"
                                    required
                                />
                            </div>
                        </div>

                        <div className="smc-form-group">
                            <label>NEW PASSWORD</label>
                            <div className="input-wrapper">
                                <Lock size={18} />
                                <input
                                    type="password"
                                    name="new_password"
                                    value={security.new_password}
                                    onChange={handleSecurityChange}
                                    className="form-control"
                                    placeholder="Minimum 8 characters"
                                    required
                                />
                            </div>
                        </div>

                        <div className="smc-form-group">
                            <label>CONFIRM NEW PASSWORD</label>
                            <div className="input-wrapper">
                                <Check size={18} />
                                <input
                                    type="password"
                                    name="confirm_password"
                                    value={security.confirm_password}
                                    onChange={handleSecurityChange}
                                    className="form-control"
                                    placeholder="••••••••"
                                    required
                                />
                            </div>
                        </div>
                    </>
                )}

                <button type="submit" className="smc-btn smc-btn-primary" disabled={saving}>
                    {saving ? 'Synchronizing...' : (activeTab === 'profile' ? 'Save Changes' : 'Update Password')}
                </button>

                {message.text && (
                    <div className={`smc-message ${message.type}`}>
                        {message.type === 'success' ? <Check size={18} /> : <AlertCircle size={18} />}
                        <span>{message.text}</span>
                    </div>
                )}
            </form>
        </div>
    );
};

export default UserProfile;
