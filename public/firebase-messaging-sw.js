// importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js');
// importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging.js');
importScripts("https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging-compat.js");

firebase.initializeApp({
    apiKey: "AIzaSyBuSSfp8WVJIIOwbRREBtGxYACuC_PB9RY",
    authDomain: "gorc-ka.firebaseapp.com",
    projectId: "gorc-ka",
    storageBucket: "gorc-ka.firebasestorage.app",
    messagingSenderId: "454946792892",
    appId: "1:454946792892:web:39fcbb115ee6c477bff7b9"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
    try {
        console.log("📩 [SW] Фоновое сообщение получено:", payload);

        if (!payload.notification) {
            console.warn("⚠️ Нет notification в payload!");
            return;
        }

        const notificationTitle = payload.notification.title || "Новое уведомление";
        const notificationBody = payload.notification.body || "У вас новое сообщение.";
        const notificationIcon = payload.notification.icon || '/assets/user/icons/gicon.png';

        console.log("✅ Уведомление:", { notificationTitle, notificationBody, notificationIcon });

        self.registration.showNotification(notificationTitle, {
            body: notificationBody,
            icon: notificationIcon,
            requireInteraction: true
        });
    } catch (error) {
        console.error("❌ Ошибка обработки фонового сообщения:", error);
    }
});
