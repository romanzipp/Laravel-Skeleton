import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

import Navigation from './components/Navigation.jsx';
import Index from './pages/Index.jsx';

function App() {
    return (
        <BrowserRouter>
            <div>
                <Navigation />
                <Routes>
                    <Route path="/" element={<Index />} />
                </Routes>
            </div>
        </BrowserRouter>
    );
}

const app = document.querySelector('#app');

if (app) {
    const root = createRoot(app);
    root.render(<App />);
}
