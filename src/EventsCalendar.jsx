import React, { useState, useEffect } from 'react';
import './EventsCalendar.css';

const EventsCalendar = () => {
    // State
    const [view, setView] = useState('list'); // 'month' or 'list'
    const [currentDate, setCurrentDate] = useState(new Date());
    const [events, setEvents] = useState([]);

    // Load data from window
    useEffect(() => {
        if (window.smcEventsData) {
            // Process dates
            const processedEvents = window.smcEventsData.map(ev => ({
                ...ev,
                startDate: new Date(ev.start),
                endDate: new Date(ev.end)
            }));
            setEvents(processedEvents);
        }
    }, []);

    // Navigation handlers
    const nextMonth = () => {
        const newDate = new Date(currentDate);
        newDate.setMonth(newDate.getMonth() + 1);
        setCurrentDate(newDate);
    };

    const prevMonth = () => {
        const newDate = new Date(currentDate);
        newDate.setMonth(newDate.getMonth() - 1);
        setCurrentDate(newDate);
    };

    const goToToday = () => {
        setCurrentDate(new Date());
    };

    // Helper functions
    const getMonthName = (date) => date.toLocaleString('default', { month: 'long', year: 'numeric' });

    // Filter events for current view
    const getEventsForMonth = (date) => {
        return events.filter(ev =>
            ev.startDate.getMonth() === date.getMonth() &&
            ev.startDate.getFullYear() === date.getFullYear()
        );
    };

    const getUpcomingEvents = () => {
        const now = new Date();
        now.setHours(0, 0, 0, 0);
        return events
            .filter(ev => ev.startDate >= now)
            .sort((a, b) => a.startDate - b.startDate);
    };

    // RENDER: Month View
    const renderMonthView = () => {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);

        const startingDay = firstDay.getDay(); // 0 = Sunday
        const totalDays = lastDay.getDate();

        const grid = [];
        const daysInPrevMonth = new Date(year, month, 0).getDate();

        // Previous month days
        for (let i = 0; i < startingDay; i++) {
            const dayNum = daysInPrevMonth - startingDay + 1 + i;
            grid.push(
                <div key={`prev-${i}`} class="smc-grid-cell outside-month">
                    <span class="smc-grid-date">{dayNum}</span>
                </div>
            );
        }

        // Current month days
        for (let i = 1; i <= totalDays; i++) {
            const currentDayDate = new Date(year, month, i);
            const isToday = currentDayDate.toDateString() === new Date().toDateString();

            // Find events for this day
            const dayEvents = events.filter(ev =>
                ev.startDate.toDateString() === currentDayDate.toDateString()
            );

            grid.push(
                <div key={`day-${i}`} class={`smc-grid-cell ${isToday ? 'today' : ''}`}>
                    <span class="smc-grid-date">{i}</span>
                    {dayEvents.map(ev => (
                        <a key={ev.id} href={ev.link} class="smc-event-marker" title={ev.title}>
                            {ev.startDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} {ev.title}
                        </a>
                    ))}
                </div>
            );
        }

        // Next month days to fill grid (assuming 6 rows max -> 42 cells)
        const remainingCells = 42 - grid.length;
        for (let i = 1; i <= remainingCells; i++) {
            grid.push(
                <div key={`next-${i}`} class="smc-grid-cell outside-month">
                    <span class="smc-grid-date">{i}</span>
                </div>
            );
        }

        return (
            <div class="smc-events-grid">
                {['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'].map(d => (
                    <div key={d} class="smc-grid-header">{d}</div>
                ))}
                {grid}
            </div>
        );
    };

    // RENDER: List View
    const renderListView = () => {
        const upcoming = getUpcomingEvents();

        if (upcoming.length === 0) {
            return <div class="smc-no-events">No upcoming events found.</div>;
        }

        return (
            <div class="smc-events-list">
                {upcoming.map(ev => (
                    <div key={ev.id} class="smc-event-card">
                        <div class="smc-event-date-box">
                            <span class="smc-date-month">{ev.startDate.toLocaleString('default', { month: 'short' })}</span>
                            <span class="smc-date-day">{ev.startDate.getDate()}</span>
                            <span class="smc-date-year">{ev.startDate.getFullYear()}</span>
                        </div>
                        <div class="smc-event-details">
                            <div class="smc-event-time-loc">
                                <span><i class="far fa-clock"></i> {ev.startDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} - {ev.endDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</span>
                                {ev.location && <span><i class="fas fa-map-marker-alt"></i> {ev.location}</span>}
                            </div>
                            <h3><a href={ev.link} class="smc-event-title-link">{ev.title}</a></h3>
                            <div class="smc-event-excerpt" dangerouslySetInnerHTML={{ __html: ev.excerpt }}></div>
                            <a href={ev.link} class="smc-event-cta">View Details</a>
                        </div>
                    </div>
                ))}
            </div>
        );
    };

    return (
        <div class="smc-events-container">
            <div class="smc-events-header-bar">
                <div class="smc-events-nav">
                    {view === 'month' && (
                        <>
                            <button onClick={prevMonth} class="smc-events-nav-btn"><i class="fas fa-chevron-left"></i></button>
                            <button onClick={goToToday} class="smc-events-nav-btn" style={{ margin: '0 10px' }}>Today</button>
                            <button onClick={nextMonth} class="smc-events-nav-btn"><i class="fas fa-chevron-right"></i></button>
                        </>
                    )}
                </div>

                <h2 class="smc-events-title">
                    {view === 'month' ? getMonthName(currentDate) : 'Upcoming Events'}
                </h2>

                <div class="smc-view-toggle">
                    <button
                        class={`smc-view-btn ${view === 'list' ? 'active' : ''}`}
                        onClick={() => setView('list')}
                    >List</button>
                    <button
                        class={`smc-view-btn ${view === 'month' ? 'active' : ''}`}
                        onClick={() => setView('month')}
                    >Month</button>
                </div>
            </div>

            {view === 'month' ? renderMonthView() : renderListView()}
        </div>
    );
};

export default EventsCalendar;
