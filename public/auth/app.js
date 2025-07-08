document.getElementsByName("role").forEach((e) => {
    e.addEventListener("click", (e) => {
        if (e.target.value == "parent") {
            document
                .getElementsByName("name")[0]
                .setAttribute("placeholder", "Enter Parent Name");
            document
                .getElementsByName("email")[0]
                .setAttribute("placeholder", "Enter Parent Email");
            document
                .getElementsByName("phone")[0]
                .setAttribute("placeholder", "Enter Parent Phone Number");
            document
                .getElementsByName("address")[0]
                .setAttribute("placeholder", "Enter Parent Address");
        } else if (e.target.value == "hospital") {
            document
                .getElementsByName("name")[0]
                .setAttribute("placeholder", "Enter Hospital Name");
            document
                .getElementsByName("email")[0]
                .setAttribute("placeholder", "Enter Hospital Email");
            document
                .getElementsByName("phone")[0]
                .setAttribute("placeholder", "Enter Hospital Phone Number");
            document
                .getElementsByName("address")[0]
                .setAttribute("placeholder", "Enter Hospital Address");
        }
    });
});
