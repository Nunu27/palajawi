import "./bootstrap";
import "../../vendor/masmerise/livewire-toaster/resources/js";

window.formatInputNumber = (
    e,
    { prefix = "", suffix = "", zero = "0", required = true } = {}
) => {
    const data = +e.target.value.replace(/[^\d]/g, "");

    e.target.value = data
        ? prefix + data.toLocaleString("id") + suffix
        : required
        ? ""
        : prefix + zero;
};
