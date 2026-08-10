import http from 'k6/http';
import { check, sleep } from 'k6';
import { htmlReport } from 'https://raw.githubusercontent.com/benc-uk/k6-reporter/main/dist/bundle.js';
import { textSummary } from 'https://jslib.k6.io/k6-summary/0.0.1/index.js';
import { login } from './lib/auth.js';

const BASE_URL = __ENV.BASE_URL || 'http://localhost:8000';
const EMAIL = __ENV.K6_EMAIL || 'admin@optical.com';
const PASSWORD = __ENV.K6_PASSWORD || 'password';

export const options = {
    scenarios: {
        smoke: {
            executor: 'shared-iterations',
            vus: 1,
            iterations: 1,
            maxDuration: '1m',
        },
    },
    thresholds: {
        http_req_duration: ['p(95)<500'],
        http_req_failed: ['rate<0.01'],
    },
};

export default function () {
    login(BASE_URL, EMAIL, PASSWORD);

    const pages = [
        '/dashboard',
        '/customers',
        '/products',
        '/orders',
        '/reservations',
        '/categories',
    ];

    for (const page of pages) {
        const res = http.get(`${BASE_URL}${page}`);
        check(res, {
            [`GET ${page} returns 200`]: (r) => r.status === 200,
        });
        sleep(0.5);
    }
}

export function handleSummary(data) {
    return {
        '/reports/k6-report.html': htmlReport(data),
        stdout: textSummary(data),
    };
}
