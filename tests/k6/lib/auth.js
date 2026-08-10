import http from 'k6/http';
import { check } from 'k6';

export function getCsrfAndCookies(baseUrl) {
    const res = http.get(`${baseUrl}/login`);
    const cookie = res.cookies['XSRF-TOKEN'];
    const xsrf = cookie ? cookie[0].value : '';
    const match = res.body.match(/name="_token"\s+value="([^"]+)"/);
    const token = match ? match[1] : '';
    return { xsrf, token };
}

export function login(baseUrl, email, password) {
    const { xsrf, token } = getCsrfAndCookies(baseUrl);
    const headers = {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-XSRF-TOKEN': xsrf,
    };
    const body = {
        _token: token,
        email: email,
        password: password,
    };
    const res = http.post(`${baseUrl}/login`, body, {
        headers,
        redirects: 0,
    });
    check(res, {
        'login redirects (302)': (r) => r.status === 302,
        'session cookie set': (r) => Object.keys(r.cookies).length > 0,
    });
    return res;
}
