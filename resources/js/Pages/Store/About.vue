<template>
    <Head title="About me" />

    <div>
        <section class="main__about_me">
            <div class="container">
                <div class="page__heading">
                    ABOUT ME
                </div>

                <div class="page__text">

                    <h3>About</h3>
                    <p>Backend web developer with fullstack capabilities. Can work on any project:
                        from simple online shops to large E-commerce projects.
                        I successfully designed and implemented several commercial projects (online shops).
                        Also, I have experience in UNIX shell scripting and system task automation.
                    </p>

                    <h4>Skills</h4>
                    <p>
                        <ul>
                            <li>Website development (HTML, CSS, SASS, BEM, Bootstrap)</li>
                            <li>OOP, MVC, SOLID</li>
                            <li>JavaScript/Typescript, React.js (core)</li>
                            <li>Node.js (core)</li>
                            <li>MySQL, MongoDB, Redis</li>
                            <li>GraphQL, Insomnia</li>
                            <li>Linux (Bash, Ksh, Zsh), Docker, Composer</li>
                            <li>Server Administration (FTP, Nginx, Apache, MySQL, SSH, VPN)</li>
                            <li>Git, GitLab</li>
                            <li>Shell scripting (Bash, Ksh)</li>
                        </ul>
                    </p>

                    <h4>Additional skills</h4>
                    <p>
                        <ul>
                            <li>Administration and maintenance of UNIX (BSD) servers (average): SSHD, Apache, Nginx, FTP, MySQL</li>
                            <li>3D modelling: AutoCAD/Mechanical Desktop (professional), Blender 3D (average)</li>
                            <li>Text copywriting/rewriting for SEO</li>
                        </ul>
                    </p>

                    <h4>Projects</h4>
                    <p>
                        <ul>
                            <li>Website for a company engaged in the production of funeral monuments (Bootstrap, AngularJS)</li>
                            <li>Online store for a local stationery company (designed on the OpenCart platform)</li>
                            <li>Full website backend for online library (PHP, JavaScript, MongoDB)</li>
                        </ul>
                    </p>
                </div>
            </div>
        </section>

        <section class="main__about_project">
            <div class="container">
                <div class="page__heading">
                    ABOUT PROJECT
                </div>

                <div class="page__text">

                    <h3>Highlights</h3>
                    <p>
                        The project itself is quite simple and all tasks is understandable. But due to
                        there is no strict instruction about how frontend must looks I do it on my own.
                    </p>

                    <h4>Key moments</h4>
                    <p>Main technology stack is Laravel 11 + Vue.js 3 + MySQL.</p>
                    <p>The test website will works from Docker therefore the <code>docker</code> and 
                        <code>docker-compose</code> must be installed in system. The Readme.md file contains all the instructions
                        to be successfully started with.
                    </p>

                    <p>The total development take fully 12 days. It took so long because there was an additional technology stack 
                        that needed to be mastered: Vue framework and some of the Laravel components (ex. Inertia).</p>

                    <h4>The problems</h4>
                    <p>The only problem I encountered on the project was the need to use new technologies that I am just learning.</p>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
    import LayoutAbout from '@/Layouts/LayoutAbout.vue';

    defineOptions({ layout: LayoutAbout });
</script>
