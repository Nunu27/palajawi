import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

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
window.formSubmit = async (e) => {
    e.preventDefault();

    try {
        const form = e.target;

        const { data: response } = await axios({
            url: form.getAttribute("action"),
            method: form.getAttribute("method") ?? "get",
            data: new FormData(form),
        });

        if (response.success && response.redirect) {
            const url = new URL(response.redirect);
            if (response.message)
                url.searchParams.set(
                    "data",
                    btoa(
                        JSON.stringify({
                            type: "success",
                            message: response.message,
                        })
                    )
                );
            window.location = url.href;
        }

        return response;
    } catch (error) {
        if (error.response) {
            error.response.data.success = false;
            return error.response.data;
        } else return { success: false, message: "Permintaan gagal" };
    }
};
