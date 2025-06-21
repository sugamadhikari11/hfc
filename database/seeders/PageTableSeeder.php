<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page\Page;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $corePages = [
            [
                'user_id' => 1,
                'parent_id' => null,
                'title' => 'About Us',
                'slug' => 'about-us',
                'sub_title' => 'The rapid and reliable electrical services for your home or offices.',
                'is_published' => 1,
                'icons' => 'bi bi-person',
                'summary' => "Newsuper Electrician Service Nepal is your trusted partner for reliable, affordable, and professional electrical services across Nepal. Whether you need a quick repair, a full installation, or long-term maintenance, our certified and experienced electricians are here to help—24/7.",
                'description' => "Newsuper Electrician Service Nepal is your trusted partner for reliable, affordable, and professional electrical services across Nepal. Whether you need a quick repair, a full installation, or long-term maintenance, our certified and experienced electricians are here to help—24/7.",
                'page_section_name' => 'about-us',
            ],
            [
                'user_id' => 1,
                'parent_id' => null,
                'title' => 'Terms & Conditions',
                'slug' => 'terms-conditions',
                'sub_title' => 'Terms & Conditions',
                'is_published' => 1,
                'icons' => 'bi bi-shield-check',
                'summary' => "The rapid and reliable electrical services for your home or offices",
                'description' => "The rapid and reliable electrical services for your home or offices",
                'page_section_name' => 'terms-conditions',
            ],
            [
                'user_id' => 1,
                'parent_id' => null,
                'title' => 'Services',
                'slug' => 'services',
                'sub_title' => 'Our Professional Electrical Services',
                'is_published' => 1,
                'icons' => 'bi bi-tools',
                'summary' => "We offer a comprehensive range of electrical services for residential and commercial clients, from installations and repairs to inspections and maintenance.",
                'description' => "<p>At All Electric Services, we pride ourselves on delivering high-quality electrical solutions tailored to meet the unique needs of each client. Our team of licensed electricians brings years of experience and expertise to every project, ensuring safe, reliable, and efficient electrical systems for your home or business.</p><p>Whether you need a simple repair, a complete rewiring, or smart home integration, we have the skills and equipment to get the job done right the first time. We stay up-to-date with the latest technologies and industry standards to provide you with cutting-edge solutions that enhance safety, efficiency, and convenience.</p>",
                'page_section_name' => 'services',
            ],
            [
                'user_id' => 1,
                'parent_id' => null,
                'title' => 'Why Choose Us',
                'slug' => 'why-choose-us',
                'sub_title' => 'Choose us for reliable, safe, and high-quality electrical services delivered',
                'is_published' => 1,
                'icons' => 'bi bi-award',
                'summary' => "Discover why our clients trust us with their electrical needs",
                'description' => "We pride ourselves on providing reliable, efficient, and professional electrical services for homes and businesses.",
                'page_section_name' => 'why-choose-us',
            ],

        ];

        foreach ($corePages as $data) {
            $total = Page::where('slug', $data['slug'])->count();
            if ($total === 0) {
                Page::create($data);
            }
        }

        $servicesPage = Page::where('slug', 'services')->first();

        if ($servicesPage) {
            $servicePages = [
                [
                    'user_id' => 1,
                    'parent_id' => $servicesPage->id,
                    'title' => 'Home Electrical Installations',
                    'slug' => 'home-electrical-installations',
                    'sub_title' => 'Efficient Installations for Modern Homes',
                    'is_published' => 1,
                    'icons' => 'bi bi-lightning',
                    'summary' => "Our skilled electricians handle full-scale installations in new homes and renovations, ensuring safety and efficiency from the ground up.",
                    'description' => "<p>We specialize in installing electrical systems in newly built homes, additions, and renovation projects. From electrical panels to light fixtures, we make sure your new installation is code-compliant and ready to use.</p><p>Our team works closely with homeowners, contractors, and designers to deliver tailored electrical layouts that align with your needs and aesthetic preferences.</p><p>Our installation services include:</p><ul><li>Wiring for new constructions</li><li>Custom lighting design and setup</li><li>Electrical panel and subpanel setup</li><li>Backup generator integration</li><li>Dedicated appliance circuits</li><li>GFCI/AFCI protection setup</li></ul>",
                    'page_section_name' => 'home-installations',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $servicesPage->id,
                    'title' => 'Industrial Electrical Contracting',
                    'slug' => 'industrial-electrical-contracting',
                    'sub_title' => 'Powering Industrial Operations with Expertise',
                    'is_published' => 1,
                    'icons' => 'bi bi-lightbulb',
                    'summary' => "Our industrial services provide large-scale electrical support for factories, plants, and heavy machinery operations.",
                    'description' => "<p>We understand the complexity of industrial electrical systems and offer tailored solutions to keep your operations safe and productive. Our team handles high-voltage systems, machinery wiring, and facility-wide power distribution with precision.</p><p>Whether it’s new installations, maintenance, or emergency service, we ensure minimal downtime and reliable energy distribution.</p><p>We offer:</p><ul><li>Industrial control systems</li><li>High voltage wiring and transformers</li><li>Motor controls and VFDs</li><li>Machine hookup and testing</li><li>Industrial lighting systems</li><li>Scheduled maintenance and inspections</li></ul>",
                    'page_section_name' => 'industrial-contracting',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $servicesPage->id,
                    'title' => 'Electrical System Upgrades',
                    'slug' => 'electrical-system-upgrades',
                    'sub_title' => 'Modernize Your Electrical Infrastructure',
                    'is_published' => 1,
                    'icons' => 'bi bi-arrow-up-circle',
                    'summary' => "We upgrade old or overloaded electrical systems to meet today’s safety codes and power demands.",
                    'description' => "<p>Outdated electrical systems can pose serious safety risks. We provide complete upgrade services to bring your wiring, panels, and circuits up to current standards.</p><p>We evaluate your current setup, recommend improvements, and perform upgrades that boost efficiency, safety, and capacity.</p><p>Upgrade services include:</p><ul><li>Service panel replacements</li><li>Fuse box to breaker conversion</li><li>Home rewiring</li><li>Grounding system updates</li><li>Additional circuits installation</li><li>Energy-efficient upgrades</li></ul>",
                    'page_section_name' => 'system-upgrades',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $servicesPage->id,
                    'title' => 'Home Automation & Security',
                    'slug' => 'home-automation-security',
                    'sub_title' => 'Smarter Living with Integrated Security',
                    'is_published' => 1,
                    'icons' => 'bi bi-shield-lock',
                    'summary' => "Install intelligent systems for home automation, surveillance, and security – all manageable from your smartphone.",
                    'description' => "<p>Enhance your lifestyle with fully integrated smart home solutions. Control your lights, locks, thermostats, and surveillance systems from anywhere, using just your phone or voice.</p><p>We offer complete system planning, setup, and user training for maximum comfort, energy savings, and security.</p><p>Automation services include:</p><ul><li>Smart home hubs and devices</li><li>App-controlled lighting</li><li>Security camera systems</li><li>Smart locks and access control</li><li>Motion sensors and alarms</li><li>Automated climate control</li></ul>",
                    'page_section_name' => 'automation-security',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $servicesPage->id,
                    'title' => '24-Hour Emergency Support',
                    'slug' => '24-hour-emergency-support',
                    'sub_title' => 'Rapid Emergency Response Around the Clock',
                    'is_published' => 1,
                    'icons' => 'bi bi-clock-history',
                    'summary' => "Unexpected electrical issues? Our emergency technicians are available 24/7 to provide immediate assistance and solutions.",
                    'description' => "<p>When power emergencies strike, you need help fast. Our emergency response electricians are on-call 24/7 to handle all urgent electrical issues with speed and professionalism.</p><p>We troubleshoot and resolve electrical failures, fire hazards, and storm-related damages with a focus on safety and long-term reliability.</p><p>We respond to:</p><ul><li>Sudden power loss</li><li>Electrical burning smells</li><li>Sparking or arcing outlets</li><li>Tripping circuit breakers</li><li>Fire or flood electrical damage</li><li>Life-support equipment failure</li></ul><p>Call our emergency hotline: <strong>(800) 555-9111</strong></p>",
                    'page_section_name' => 'emergency-support',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $servicesPage->id,
                    'title' => 'Industrial Electrical Solutions',
                    'slug' => 'industrial-electrical-solutions',
                    'sub_title' => 'Powering Your Manufacturing Needs',
                    'is_published' => 1,
                    'icons' => 'bi bi-gear-wide-connected',
                    'summary' => "Specialized electrical services for factories, plants, and industrial facilities to keep your operations running smoothly.",
                    'description' => "<p>Our industrial electrical services are tailored for heavy-duty environments. We understand the critical nature of industrial power systems and provide reliable solutions that minimize downtime.</p><p>Our certified industrial electricians work with high-voltage systems, three-phase power, and complex machinery electrical needs. We adhere to strict safety protocols while delivering efficient service.</p><p>Industrial services include:</p><ul><li>Motor control center maintenance</li><li>PLC wiring and troubleshooting</li><li>High-voltage system installation</li><li>Industrial lighting solutions</li><li>Preventive maintenance programs</li><li>Conduit and cable tray systems</li><li>Explosion-proof installations</li></ul>",
                    'page_section_name' => 'industrial-services',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $servicesPage->id,
                    'title' => 'Solar Power Installation',
                    'slug' => 'solar-power-installation',
                    'sub_title' => 'Sustainable Energy Solutions',
                    'is_published' => 1,
                    'icons' => 'bi bi-sun',
                    'summary' => "Professional solar panel installation and renewable energy system integration for homes and businesses.",
                    'description' => "<p>Transition to clean energy with our comprehensive solar power services. We design and install customized solar solutions that maximize your energy savings and reduce your carbon footprint.</p><p>Our NABCEP-certified solar installers handle everything from initial consultation and system design to permitting, installation, and maintenance. We work with top-quality solar equipment to ensure long-term performance.</p><p>Solar services include:</p><ul><li>Residential solar panel installation</li><li>Commercial solar systems</li><li>Solar battery storage solutions</li><li>Solar system maintenance</li><li>Solar monitoring system setup</li><li>Solar incentive program assistance</li><li>Off-grid solar solutions</li></ul>",
                    'page_section_name' => 'solar-services',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $servicesPage->id,
                    'title' => 'Data Center Electrical',
                    'slug' => 'data-center-electrical',
                    'sub_title' => 'Mission-Critical Power Systems',
                    'is_published' => 1,
                    'icons' => 'bi bi-server',
                    'summary' => "Specialized electrical services for data centers, server rooms, and IT infrastructure facilities.",
                    'description' => "<p>Data centers require specialized electrical expertise to ensure uninterrupted operation. We provide electrical solutions designed for high-availability environments where uptime is critical.</p><p>Our team is experienced in redundant power systems, precision cooling power requirements, and backup power solutions. We understand the unique electrical demands of data centers and work to optimize power distribution and efficiency.</p><p>Data center services include:</p><ul><li>UPS system installation</li><li>PDU maintenance and upgrades</li><li>Generator system integration</li><li>Power monitoring systems</li><li>Busway installation</li><li>Grounding and bonding for sensitive equipment</li><li>Energy efficiency audits</li></ul>",
                    'page_section_name' => 'data-center-services',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $servicesPage->id,
                    'title' => 'EV Charging Stations',
                    'slug' => 'ev-charging-stations',
                    'sub_title' => 'Electric Vehicle Infrastructure',
                    'is_published' => 1,
                    'icons' => 'bi bi-ev-station',
                    'summary' => "Professional installation of electric vehicle charging stations for homes, businesses, and public facilities.",
                    'description' => "<p>As electric vehicles become mainstream, we provide the charging infrastructure to support this transition. Our EV charging solutions range from basic home chargers to commercial charging stations.</p><p>We assess your electrical capacity, recommend the right charging solution, and handle all aspects of installation including permitting and utility coordination. Our installations meet all safety standards and manufacturer specifications.</p><p>EV charging services include:</p><ul><li>Home EV charger installation</li><li>Commercial charging stations</li><li>Fast-charging DC installations</li><li>Load management systems</li><li>Networked charging solutions</li><li>Electrical panel upgrades for EV charging</li><li>Incentive program assistance</li></ul>",
                    'page_section_name' => 'ev-charging',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $servicesPage->id,
                    'title' => 'Electrical Safety Inspections',
                    'slug' => 'electrical-safety-inspections',
                    'sub_title' => 'Comprehensive Electrical Evaluations',
                    'is_published' => 1,
                    'icons' => 'bi bi-clipboard2-check',
                    'summary' => "Thorough electrical safety inspections to identify potential hazards and ensure code compliance.",
                    'description' => "<p>Our electrical safety inspections provide peace of mind by identifying potential hazards before they become serious problems. We use advanced diagnostic tools to assess your electrical system's condition.</p><p>Whether you're a homeowner, business owner, or property manager, our detailed inspections help prevent electrical fires, equipment damage, and safety hazards. We provide clear reports with prioritized recommendations.</p><p>Inspection services include:</p><ul><li>Home electrical safety inspections</li><li>Commercial property inspections</li><li>Pre-purchase electrical inspections</li><li>Insurance compliance inspections</li><li>Thermal imaging scans</li><li>Ground fault protection testing</li><li>Arc fault detection verification</li></ul><p>Schedule your inspection today: <strong>(555) 123-4567</strong></p>",
                    'page_section_name' => 'safety-inspections',
                ]
            ];

            foreach ($servicePages as $data) {
                $total = Page::where('slug', $data['slug'])->count();
                if ($total === 0) {
                    Page::create($data);
                }
            }
        }


        $whyChooseUsPage = Page::where('slug', 'why-choose-us')->first();

        if ($whyChooseUsPage) {
            $features = [
                [
                    'user_id' => 1,
                    'parent_id' => $whyChooseUsPage->id,
                    'title' => 'Rapid & Reliable Service',
                    'slug' => 'rapid-reliable-service',
                    'sub_title' => '',
                    'is_published' => 1,
                    'icons' => 'bi bi-lightning',
                    'summary' => "Round-the-clock assistance, ensuring client safety throughout their electrical project.",
                    'description' => "Our rapid response team is available 24/7 to address any electrical emergencies or urgent needs. We understand that electrical issues can disrupt your life or business, which is why we prioritize quick response times and efficient service delivery.",
                    'page_section_name' => 'feature-rapid-service',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $whyChooseUsPage->id,
                    'title' => 'Affordable Pricing',
                    'slug' => 'affordable-pricing',
                    'sub_title' => '',
                    'is_published' => 1,
                    'icons' => 'bi bi-cash-coin',
                    'summary' => "Competitive rates without compromising on quality, providing excellent value for all electrical work.",
                    'description' => "We offer competitive, transparent pricing with no hidden costs. Our quotes are detailed and fair, ensuring you get excellent value for high-quality electrical work. We work within your budget without compromising on quality or safety.",
                    'page_section_name' => 'feature-pricing',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $whyChooseUsPage->id,
                    'title' => '100% Customer Satisfaction',
                    'slug' => '100-customer-satisfaction',
                    'sub_title' => '',
                    'is_published' => 1,
                    'icons' => 'bi bi-emoji-smile',
                    'summary' => "Committed to exceptional service quality and complete customer satisfaction on every project.",
                    'description' => "Our commitment to customer satisfaction drives everything we do. We listen carefully to your needs, communicate clearly throughout the process, and ensure that our work meets or exceeds your expectations. Our success is measured by your satisfaction.",
                    'page_section_name' => 'feature-satisfaction',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $whyChooseUsPage->id,
                    'title' => 'Installation, Maintenance & Repairs',
                    'slug' => 'installation-maintenance-repairs',
                    'sub_title' => '',
                    'is_published' => 1,
                    'icons' => 'bi bi-tools',
                    'summary' => "Comprehensive electrical services from installation and maintenance to prompt repairs.",
                    'description' => "We provide a full spectrum of electrical services, from new installations and system upgrades to routine maintenance and emergency repairs. Our skilled technicians are equipped to handle all your electrical needs, ensuring your systems function safely and efficiently.",
                    'page_section_name' => 'feature-services',
                ],
            ];

            foreach ($features as $data) {
                $total = Page::where('slug', $data['slug'])->count();
                if ($total === 0) {
                    Page::create($data);
                }
            }
        }
    }
}
