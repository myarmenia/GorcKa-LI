import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

let messaging = null; // Глобальная переменная для объекта messaging

/**
 * Инициализирует Firebase с переданной конфигурацией.
 * Регистрирует Service Worker и настраивает обработчик входящих уведомлений.
 * @param {Object} firebaseConfig - Объект клиентской конфигурации Firebase.
 */

export const initFirebase = (firebaseConfig) => {
    // Инициализируем Firebase с переданной конфигурацией
    const firebaseApp = initializeApp(firebaseConfig);
    messaging = getMessaging(firebaseApp);

    // Регистрация Service Worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/firebase-messaging-sw.js')
            .then((registration) => {
                console.log('Service Worker зарегистрирован:', registration);
            })
            .catch((err) => {
                console.log('Ошибка регистрации Service Worker:', err);
            });
    }

    // Регистрация обработчика входящих уведомлений
    onMessage(messaging, (payload) => {
        console.log("Получено уведомление:", payload);
        new Notification(payload.notification.title, {
            body: payload.notification.body,
            // При необходимости можно добавить icon: payload.notification.icon
        });
    });
};

/**
 * Запрашивает разрешение на уведомления и, при успехе, получает FCM-токен.
 * @param {string} firebaseVapIdKey - vapidKey, передаваемый из props.
 */
export const requestPermission = async (firebaseVapIdKey) => {
    try {
        const permission = await Notification.requestPermission();
        if (permission === "granted") {
            const token = await getToken(messaging, { vapidKey: firebaseVapIdKey });
            console.log("FCM Token:", token);
            await sendTokenToServer(token);
        } else {
            console.log("Разрешение не предоставлено");
        }
    } catch (error) {
        console.error("Ошибка получения токена", error);
    }
};

/**
 * Отправляет полученный FCM-токен на сервер Laravel.
 * @param {string} token - FCM-токен.
 */
const sendTokenToServer = async (token) => {
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    await fetch("/save-fcm-token", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({ token }),
    });
};
