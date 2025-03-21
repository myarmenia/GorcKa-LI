import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

const firebaseConfig = {
    apiKey: "AIzaSyBuSSfp8WVJIIOwbRREBtGxYACuC_PB9RY",
    authDomain: "gorc-ka.firebaseapp.com",
    projectId: "gorc-ka",
    storageBucket: "gorc-ka.firebasestorage.app",
    messagingSenderId: "454946792892",
    appId: "1:454946792892:web:39fcbb115ee6c477bff7b9"
};



// Инициализируем Firebase
const firebaseApp = initializeApp(firebaseConfig);
const messaging = getMessaging(firebaseApp);

// Запрос на разрешение уведомлений
export const requestPermission = async () => {
    try {
        const permission = await Notification.requestPermission();
        if (permission === "granted") {
            const token = await getToken(messaging, { vapidKey: "BCXm3mH-6UsKToaIcsF8-cj16iyKGU5OWb999twsped9xOABiwlB-tIteRMx9wp4kqzprdytZFxoUrhNBhkiM5s" });
            console.log("FCM Token:", token);
            sendTokenToServer(token);
        }
    } catch (error) {
        console.error("Ошибка получения токена", error);
    }
};

// Отправка токена на сервер Laravel
const sendTokenToServer = async (token) => {
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    await fetch("/save-fcm-token", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,  // Добавляем CSRF токен
        },
        body: JSON.stringify({ token }),
    });
};

// Ловим входящие уведомления
onMessage(messaging, (payload) => {
    console.log("Получено уведомление:", payload);
    new Notification(payload.notification.title, {
        body: payload.notification.body,
        icon: payload.notification.icon
    });
});
