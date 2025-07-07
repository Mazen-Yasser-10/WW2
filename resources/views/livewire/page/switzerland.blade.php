<?php

use Livewire\Volt\Component;

new class extends Component
{
    //
};
?>

<div>
    <head>
        <meta charset="UTF-8">
        <title>Germany in World War II</title>
        <style>
            body {
                background: url('https://i.ibb.co/0RY7PQmm/1.png') center center / cover no-repeat fixed;
                color: #fff;
                font-family: Arial, sans-serif;
                padding: 2rem;
                margin: 0;
                min-height: 100vh;
            }

            h1 {
                font-size: 3rem;
                font-weight: bold;
                margin-bottom: 2rem;
                text-align: center;
                text-transform: uppercase;
            }

            .story {
                margin-bottom: 2rem;
                line-height: 1.8;
                font-size: 1.1rem;
                background-color: rgba(0, 0, 0, 0.6);
                padding: 1rem;
                border-radius: 10px;
            }

            .story-title {
                font-size: 1.5rem;
                font-weight: bold;
                margin-bottom: 0.5rem;
                color: #FFD700;
            }

            ul {
                margin-left: 1.5rem;
            }

            ul li {
                margin-bottom: 0.4rem;
            }
        </style>

    </head>

    <h1>Germany in World War II</h1>

    @php
        $sections = [
            [
                'title' => '1. Rise of the Nazis',
                'paragraphs' => [
                    'After World War I, Germany was left in political and economic turmoil. The Treaty of Versailles, signed in 1919, imposed harsh reparations, territorial losses, and military restrictions on Germany, leading to widespread resentment and economic collapse. Hyperinflation in the early 1920s wiped out savings, and the Great Depression further fueled unemployment and despair.',
                    'Amidst this chaos, radical political ideologies gained traction. The Nazi Party, led by Adolf Hitler, rose to prominence by exploiting nationalistic sentiment and promising to restore Germany’s greatness. In 1933, Hitler was appointed Chancellor, and shortly after, he consolidated power by dismantling democratic institutions and establishing a totalitarian regime.',
                ],
                'points' => [
                    '1919: Treaty of Versailles signed',
                    '1923: Hyperinflation crisis',
                    '1933: Hitler becomes Chancellor and later Führer',
                ]
            ],
            [
                'title' => '2. Start of the War',
                'paragraphs' => [
                    'Under Hitler’s leadership, Germany began openly defying the Treaty of Versailles by rearming and pursuing aggressive expansionism. The remilitarization of the Rhineland in 1936 went unchallenged by Western powers, emboldening Hitler. In 1938, Germany annexed Austria (the Anschluss) and later seized the Sudetenland from Czechoslovakia, under the pretense of protecting German-speaking people.',
                    'On September 1, 1939, Germany invaded Poland using the Blitzkrieg strategy. In response, Britain and France declared war, marking the beginning of World War II. Hitler justified his actions with propaganda and false-flag operations, such as the Gleiwitz incident, designed to portray Germany as a victim.',
                ],
                'points' => [
                    '1936: Rhineland remilitarized',
                    '1938: Anschluss with Austria',
                    '1939: Invasion of Poland and start of WWII',
                ]
            ],
            [
                'title' => '3. Blitzkrieg and Early Victories',
                'paragraphs' => [
                    'Germany employed Blitzkrieg or "lightning war" tactics—using coordinated attacks by air and land forces to overwhelm enemies rapidly. This approach led to swift victories across Europe. France fell in just six weeks, and the Maginot Line—France’s main defense—was bypassed through Belgium.',
                    'By mid-1940, Germany controlled much of Western Europe. However, the Battle of Britain marked Germany’s first major failure. Despite intense bombing campaigns, the British Royal Air Force successfully defended the UK, preventing a German invasion.',
                ],
                'points' => [
                    '1940: Fall of France and Low Countries',
                    '1940: Battle of Britain – German Luftwaffe defeated',
                ]
            ],
            [
                'title' => '4. The Eastern Front',
                'paragraphs' => [
                    'In June 1941, Germany launched Operation Barbarossa, the largest military invasion in history, against the Soviet Union. The invasion opened a brutal Eastern Front, characterized by extreme weather, long supply lines, and massive casualties. German forces made deep advances but were halted outside Moscow by winter and fierce Soviet resistance.',
                    'The turning point came at the Battle of Stalingrad (1942–1943), where German troops were encircled and defeated. It marked the beginning of a Soviet counteroffensive that would gradually push Germany back toward Berlin.',
                ],
                'points' => [
                    '1941: Operation Barbarossa begins',
                    '1942-43: Battle of Stalingrad – major Soviet victory',
                ]
            ],
            [
                'title' => '5. The Holocaust',
                'paragraphs' => [
                    'Alongside military operations, the Nazi regime implemented the Holocaust—a state-sponsored genocide targeting Jews, Roma, disabled individuals, and others deemed "undesirable." Anti-Semitic laws and propaganda escalated into mass extermination.',
                    'Millions were deported to concentration and extermination camps like Auschwitz, where they were murdered in gas chambers or died from starvation, forced labor, and disease. The Holocaust claimed over six million Jewish lives and remains one of history’s darkest atrocities.',
                ],
                'points' => [
                    '1935: Nuremberg Laws enacted',
                    '1941–1945: Systematic extermination in death camps',
                    '1945: Camps liberated by Allied forces',
                ]
            ],
            [
                'title' => '6. Fall of the Third Reich',
                'paragraphs' => [
                    'Germany\'s fortunes declined after 1943 as the Allies advanced from both the east and west. Italy surrendered in 1943, and in June 1944, the Allies launched the D-Day invasion of Normandy, establishing a Western front. The Soviet army continued its push westward, liberating Eastern Europe.',
                    'By April 1945, Soviet forces had encircled Berlin. Hitler, refusing to surrender, committed suicide in his bunker. A week later, Germany surrendered unconditionally, bringing the European conflict to an end.',
                ],
                'points' => [
                    '1944: D-Day – Allied landing in France',
                    'April 1945: Battle of Berlin',
                    'May 8, 1945: V-E Day (Victory in Europe)',
                ]
            ],
            [
                'title' => '7. Aftermath',
                'paragraphs' => [
                    'Post-war Germany was devastated. Cities were in ruins, infrastructure destroyed, and millions displaced. The country was divided into four occupation zones controlled by the Allies. Eventually, it split into West Germany (Federal Republic of Germany) and East Germany (German Democratic Republic) during the Cold War.',
                    'The Nuremberg Trials brought Nazi leaders to justice, establishing a precedent for international law. Meanwhile, West Germany underwent reconstruction through the Marshall Plan, leading to economic recovery and eventual reunification in 1990 after the fall of the Berlin Wall.',
                ],
                'points' => [
                    '1945–1946: Nuremberg Trials',
                    '1949: Division into East and West Germany',
                    '1990: German reunification',
                ]
            ]
        ];
    @endphp

    @foreach ($sections as $section)
        <div class="story">
            <div class="story-title">{{ $section['title'] }}</div>
            @foreach ($section['paragraphs'] as $para)
                <p>{{ $para }}</p>
            @endforeach
            <ul>
                @foreach ($section['points'] as $point)
                    <li>{{ $point }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
