<?php
$pageTitle = 'Dashboard';
include 'layouts/header.php';
if (isset($_GET['username'])) {
    $username = urldecode($_GET['username']);
}
?>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
    </symbol>
</svg>

<div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
    <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (dark)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
            <use href="#moon-stars-fill"></use>
        </svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                    <use href="#sun-fill"></use>
                </svg>
                Light
                <svg class="bi ms-auto d-none" width="1em" height="1em">
                    <use href="#check2"></use>
                </svg>
            </button>
        </li>
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="dark" aria-pressed="true">
                <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                    <use href="#moon-stars-fill"></use>
                </svg>
                Dark
                <svg class="bi ms-auto d-none" width="1em" height="1em">
                    <use href="#check2"></use>
                </svg>
            </button>
        </li>
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
                <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                    <use href="#circle-half"></use>
                </svg>
                Auto
                <svg class="bi ms-auto d-none" width="1em" height="1em">
                    <use href="#check2"></use>
                </svg>
            </button>
        </li>
    </ul>
</div>


<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> <?php
                                            if (isset($username)) {
                                                echo "Username : $username";
                                            } else {
                                                echo 'Guest';
                                            }
                                            ?></a>
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Switch account</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Settings</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<div class="nav-scroller bg-body shadow-sm">
    <nav class="nav" aria-label="Secondary navigation">
        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
        <a class="nav-link" href="#">
            Friends
            <span class="badge text-bg-light rounded-pill align-text-bottom">27</span>
        </a>
        <a class="nav-link" href="#">Explore</a>
        <a class="nav-link" href="#">Suggestions</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">Link</a>
    </nav>
</div>

<main class="container">


    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Recent updates</h6>
        <div class="d-flex text-body-secondary pt-3">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
            </svg>
            <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="d-block text-gray-dark">@username</strong>
                Some representative placeholder content, with some information about this user. Imagine this being some sort of status update, perhaps?
            </p>
        </div>
        <div class="d-flex text-body-secondary pt-3">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#e83e8c"></rect><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text>
            </svg>
            <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="d-block text-gray-dark">@username</strong>
                Some more representative placeholder content, related to this other user. Another status update, perhaps.
            </p>
        </div>
        <div class="d-flex text-body-secondary pt-3">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#6f42c1"></rect><text x="50%" y="50%" fill="#6f42c1" dy=".3em">32x32</text>
            </svg>
            <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="d-block text-gray-dark">@username</strong>
                This user also gets some representative placeholder content. Maybe they did something interesting, and you really want to highlight this in the recent updates.
            </p>
        </div>
        <small class="d-block text-end mt-3">
            <a href="#">All updates</a>
        </small>
    </div>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Suggestions</h6>
        <div class="d-flex text-body-secondary pt-3">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
            </svg>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">Full Name</strong>
                    <a href="#">Follow</a>
                </div>
                <span class="d-block">@username</span>
            </div>
        </div>
        <div class="d-flex text-body-secondary pt-3">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
            </svg>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">Full Name</strong>
                    <a href="#">Follow</a>
                </div>
                <span class="d-block">@username</span>
            </div>
        </div>
        <div class="d-flex text-body-secondary pt-3">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
            </svg>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">Full Name</strong>
                    <a href="#">Follow</a>
                </div>
                <span class="d-block">@username</span>
            </div>
        </div>
        <small class="d-block text-end mt-3">
            <a href="#">All suggestions</a>
        </small>
    </div>
</main>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script src="offcanvas-navbar.js"></script>

<script>
    function returnCommentSymbol(language = "javascript") {
        const languageObject = {
            bat: "@REM",
            c: "//",
            csharp: "//",
            cpp: "//",
            closure: ";;",
            coffeescript: "#",
            dockercompose: "#",
            css: "/*DELIMITER*/",
            "cuda-cpp": "//",
            dart: "//",
            diff: "#",
            dockerfile: "#",
            fsharp: "//",
            "git-commit": "//",
            "git-rebase": "#",
            go: "//",
            groovy: "//",
            handlebars: "{{!--DELIMITER--}}",
            hlsl: "//",
            html: "<!--DELIMITER-->",
            ignore: "#",
            ini: ";",
            java: "//",
            javascript: "//",
            javascriptreact: "//",
            json: "//",
            jsonc: "//",
            julia: "#",
            latex: "%",
            less: "//",
            lua: "--",
            makefile: "#",
            markdown: "<!--DELIMITER-->",
            "objective-c": "//",
            "objective-cpp": "//",
            perl: "#",
            perl6: "#",
            php: "<!--DELIMITER-->",
            powershell: "#",
            properties: ";",
            jade: "//-",
            python: "#",
            r: "#",
            razor: "<!--DELIMITER-->",
            restructuredtext: "..",
            ruby: "#",
            rust: "//",
            scss: "//",
            shaderlab: "//",
            shellscript: "#",
            sql: "--",
            svg: "<!--DELIMITER-->",
            swift: "//",
            tex: "%",
            typescript: "//",
            typescriptreact: "//",
            vb: "'",
            xml: "<!--DELIMITER-->",
            xsl: "<!--DELIMITER-->",
            yaml: "#"
        }
        if (!languageObject[language]) {
            return languageObject["python"].split("DELIMITER")
        }
        return languageObject[language].split("DELIMITER")
    }
    var savedChPos = 0
    var returnedSuggestion = ''
    let editor, doc, cursor, line, pos
    pos = {
        line: 0,
        ch: 0
    }
    var suggestionsStatus = false
    var docLang = "python"
    var suggestionDisplayed = false
    var isReturningSuggestion = false
    document.addEventListener("keydown", (event) => {
        setTimeout(() => {
            editor = event.target.closest('.CodeMirror');
            if (editor) {
                const codeEditor = editor.CodeMirror
                if (!editor.classList.contains("added-tab-function")) {
                    editor.classList.add("added-tab-function")
                    codeEditor.removeKeyMap("Tab")
                    codeEditor.setOption("extraKeys", {
                        Tab: (cm) => {

                            if (returnedSuggestion) {
                                acceptTab(returnedSuggestion)
                            } else {
                                cm.execCommand("defaultTab")
                            }
                        }
                    })
                }
                doc = editor.CodeMirror.getDoc()
                cursor = doc.getCursor()
                line = doc.getLine(cursor.line)
                pos = {
                    line: cursor.line,
                    ch: line.length
                }

                if (cursor.ch > 0) {
                    savedChPos = cursor.ch
                }

                const fileLang = doc.getMode().name
                docLang = fileLang
                const commentSymbol = returnCommentSymbol(fileLang)
                if (event.key == "?") {
                    var lastLine = line
                    lastLine = lastLine.slice(0, savedChPos - 1)

                    if (lastLine.trim().startsWith(commentSymbol[0])) {
                        if (fileLang !== "null") {
                            lastLine += " " + fileLang
                        }

                        lastLine = lastLine.split(commentSymbol[0])[1]
                        window.postMessage({
                            source: 'getQuery',
                            payload: {
                                data: lastLine
                            }
                        })
                        isReturningSuggestion = true
                        displayGrey("\nBlackbox loading...")
                    }
                } else if (event.key === "Enter" && suggestionsStatus && !isReturningSuggestion) {
                    var query = doc.getRange({
                        line: Math.max(0, cursor.line - 50),
                        ch: 0
                    }, {
                        line: cursor.line,
                        ch: line.length
                    })
                    window.postMessage({
                        source: 'getSuggestion',
                        payload: {
                            data: query,
                            language: docLang,
                            cursorPos: pos
                        }
                    })
                    displayGrey("Blackbox loading...")
                } else if (event.key === "ArrowRight" && returnedSuggestion) {
                    acceptTab(returnedSuggestion)
                } else if (event.key === "Enter" && isReturningSuggestion) {
                    displayGrey("\nBlackbox loading...")
                } else if (event.key === "Escape") {
                    displayGrey("")
                }
            }
        }, 0)
    })

    function acceptTab(text) {
        if (suggestionDisplayed) {
            displayGrey("")
            doc.replaceRange(text, pos)
            returnedSuggestion = ""
            updateSuggestionStatus(false)
        }
    }

    function acceptSuggestion(text) {
        displayGrey("")
        doc.replaceRange(text, pos)
        returnedSuggestion = ""
        updateSuggestionStatus(false)
    }

    function displayGrey(text) {
        if (!text) {
            document.querySelector(".blackbox-suggestion").remove()
            return
        }
        var el = document.querySelector(".blackbox-suggestion")
        if (!el) {
            el = document.createElement('span')
            el.classList.add("blackbox-suggestion")
            el.style = 'color:grey'
            el.innerText = text
        } else {
            el.innerText = text
        }

        var lineIndex = pos.line;
        editor.getElementsByClassName('CodeMirror-line')[lineIndex].appendChild(el)
    }

    function updateSuggestionStatus(s) {
        suggestionDisplayed = s
        window.postMessage({
            source: 'updateSuggestionStatus',
            status: suggestionDisplayed,
            suggestion: returnedSuggestion
        })
    }
    window.addEventListener('message', (event) => {
        if (event.source !== window) return
        if (event.data.source == 'return') {
            isReturningSuggestion = false
            const formattedCode = formatCode(event.data.payload.data)
            returnedSuggestion = formattedCode
            displayGrey(formattedCode)
            updateSuggestionStatus(true)
        }
        if (event.data.source == 'suggestReturn') {
            const prePos = event.data.payload.cursorPos
            if (pos.line == prePos.line && pos.ch == prePos.ch) {
                returnedSuggestion = event.data.payload.data
                displayGrey(event.data.payload.data)
                updateSuggestionStatus(true)
            } else {
                displayGrey()
            }
        }
        if (event.data.source == 'codeSearchReturn') {
            isReturningSuggestion = false
            displayGrey()
        }
        if (event.data.source == 'suggestionsStatus') {
            suggestionsStatus = event.data.payload.enabled
        }
        if (event.data.source == 'acceptSuggestion') {

            acceptSuggestion(event.data.suggestion)
        }
    })
    document.addEventListener("keyup", function() {
        returnedSuggestion = ""
        updateSuggestionStatus(false)
    })

    function formatCode(data) {
        if (Array.isArray(data)) {
            var finalCode = ""
            var pairs = []

            const commentSymbol = returnCommentSymbol(docLang)
            data.forEach((codeArr, idx) => {
                const code = codeArr[0]
                var desc = codeArr[1]
                const descArr = desc.split("\n")
                var finalDesc = ""
                descArr.forEach((descLine, idx) => {
                    const whiteSpace = descLine.search(/\S/)
                    if (commentSymbol.length < 2 || idx === 0) {
                        finalDesc += insert(descLine, whiteSpace, commentSymbol[0])
                    }
                    if (commentSymbol.length > 1 && idx === descArr.length - 1) {
                        finalDesc = finalDesc + commentSymbol[1] + "\n"
                    }
                })

                finalCode += finalDesc + "\n\n" + code
                pairs.push(finalCode)
            })
            return "\n" + pairs.join("\n")
        }

        return "\n" + data
    }

    function insert(str, index, value) {
        return str.substr(0, index) + value + str.substr(index)
    }
</script>

<?php
include 'layouts/footer.php'
?>