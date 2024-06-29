import Swal from "sweetalert2";

export default {
    showToast({ title, icon }) {
        Swal.fire({
            toast: true,
            icon: icon,
            title: title,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,

        });
    },
    showSwal({
        title,
        text,
        icon,
        confirmButtonText,
        confirmButtonColor,
        cancelButtonColor,
        showCancelButton,
    }) {
        const options = {
            title,
            text,
            icon,
            showCancelButton,
            confirmButtonText,
            confirmButtonColor,
            cancelButtonColor,
            showConfirmButton: showCancelButton, // Adjust showConfirmButton based on showCancelButton
        };

        return Swal.fire(options);
    },
    formatNumber(number) {
        return  (number?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) ;

    },
    formatDate(date) {
        let formattedDate = new Date(date)
            .toLocaleDateString("en-GB", {
                minute: "numeric",
                hour: "numeric",
                day: "numeric",
                month: "short",
                year: "numeric",
            })
            .split(" ")
            .join(" ");
        return formattedDate;
    },
    formatTimeOnly(date) {
        const options = {
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
        };

        let formattedTime = new Date(date).toLocaleTimeString("en-GB", options);
        return formattedTime;
    },
    formatDateWithoutTime(date) {
        let formattedDate = new Date(date)
            .toLocaleDateString("en-GB", {
                day: "numeric",
                month: "short",
                year: "numeric",
            })
            .split(" ")
            .join(" ");
        return formattedDate;
    },
    timeSince(date) {
        let now = new Date();
        now.setTime(now.getTime() /* - 60*60*1000*/);
        let seconds = Math.floor((now - new Date(date)) / 1000);
        let interval = seconds / 31536000;
        if (interval > 1) {
            return Math.floor(interval) + " years" + " ago";
        }
        interval = seconds / 2592000;
        if (interval > 1) {
            return Math.floor(interval) + " months" + " ago";
        }
        interval = seconds / 86400;
        if (interval > 1) {
            return Math.floor(interval) + " days" + " ago";
        }
        interval = seconds / 3600;
        if (interval > 1) {
            return Math.floor(interval) + " hours" + " ago";
        }
        interval = seconds / 60;
        if (interval > 1) {
            return Math.floor(interval) + " minutes" + " ago";
        }
        return Math.floor(seconds) + " seconds" + " ago";
    },
    capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    },
    capitalizeWords(string) {
        return string.replace(/(?:^|\s)\S/g, function (a) {
            return a.toUpperCase();
        });
    },
};
