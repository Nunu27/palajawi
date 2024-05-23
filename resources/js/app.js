import "./bootstrap";
import "../../vendor/masmerise/livewire-toaster/resources/js";

window.formatInputNumber = (
    e,
    { prefix = "", suffix = "", zero = "0", required = true } = {}
) => {
    const data = +e.target.value.replace(/[^\d]/g, "");

    e.target.value = formatNumber(data, {
        prefix: prefix,
        suffix: suffix,
        zero: zero,
        required: required,
    });
};

window.formatNumber = (
    number,
    { prefix = "", suffix = "", zero = "0", required = true } = {}
) => {
    return number
        ? prefix + number.toLocaleString("id") + suffix
        : required
        ? ""
        : prefix + zero;
};
