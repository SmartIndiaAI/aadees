<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        $pageContents = [
            'site_description' => 'Premium multi-vendor marketplace curated for quality, style, and performance.',
            'about_us_content' => '
                <h1>About Aadees</h1>
                <p>Welcome to Aadees, your premier destination for premium multi-vendor marketplace products. We are committed to curating high-quality items that combine style, performance, and craftsmanship.</p>

                <h2>Our Mission</h2>
                <p>At Aadees, we believe in connecting talented artisans and vendors with discerning customers who appreciate quality and uniqueness. Our platform serves as a bridge between creators and consumers, fostering a community built on trust, innovation, and excellence.</p>

                <h2>What We Offer</h2>
                <ul>
                    <li>Curated selection of premium products from verified vendors</li>
                    <li>Secure payment processing through Razorpay</li>
                    <li>Fast and reliable shipping across India</li>
                    <li>Dedicated customer support</li>
                    <li>Quality assurance and satisfaction guarantee</li>
                </ul>

                <h2>Our Commitment</h2>
                <p>We are dedicated to providing an exceptional shopping experience. Every product on our platform undergoes careful review to ensure it meets our standards of quality and authenticity. Your satisfaction is our top priority.</p>
            ',

            'shipping_info_content' => '
                <h1>Returns & Shipping Policy</h1>

                <h2>Shipping Information</h2>
                <p>We offer fast and reliable shipping across India. Our shipping partners ensure your orders reach you safely and on time.</p>

                <h3>Shipping Charges</h3>
                <ul>
                    <li>Free shipping on orders above ₹999</li>
                    <li>Standard shipping: ₹99 for orders below ₹999</li>
                    <li>Express shipping: ₹199 (available for select locations)</li>
                </ul>

                <h3>Delivery Time</h3>
                <ul>
                    <li>Standard delivery: 3-5 business days</li>
                    <li>Express delivery: 1-2 business days</li>
                    <li>International shipping: 7-14 business days</li>
                </ul>

                <h2>Returns Policy</h2>
                <p>We want you to be completely satisfied with your purchase. If you\'re not happy with your order, you can return it within 30 days of delivery.</p>

                <h3>Return Conditions</h3>
                <ul>
                    <li>Items must be in original condition and packaging</li>
                    <li>Tags and labels must be intact</li>
                    <li>Items must not have been used or worn</li>
                    <li>Return request must be initiated within 30 days</li>
                </ul>

                <h3>Return Process</h3>
                <ol>
                    <li>Contact our customer support team</li>
                    <li>Provide order number and reason for return</li>
                    <li>Receive return authorization and shipping label</li>
                    <li>Pack and ship the item using provided label</li>
                    <li>Refund processed within 5-7 business days after receipt</li>
                </ol>

                <h3>Exchanges</h3>
                <p>We offer exchanges for different sizes or colors. Exchange requests must be made within 30 days of delivery. Shipping charges for exchanges may apply.</p>
            ',

            'terms_of_service_content' => '
                <h1>Terms of Service</h1>

                <p><strong>Last updated:</strong> ' . date('F j, Y') . '</p>

                <h2>Acceptance of Terms</h2>
                <p>By accessing and using Aadees, you accept and agree to be bound by the terms and provision of this agreement.</p>

                <h2>Use License</h2>
                <p>Permission is granted to temporarily access the materials on Aadees for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
                <ul>
                    <li>Modify or copy the materials</li>
                    <li>Use the materials for any commercial purpose or for any public display</li>
                    <li>Attempt to decompile or reverse engineer any software contained on Aadees</li>
                    <li>Remove any copyright or other proprietary notations from the materials</li>
                </ul>

                <h2>User Accounts</h2>
                <p>When you create an account with us, you must provide information that is accurate, complete, and current at all times. You are responsible for safeguarding the password and for all activities that occur under your account.</p>

                <h2>Prohibited Uses</h2>
                <p>You may not use our products for any illegal or unauthorized purpose. You must not transmit any worms or viruses or any code of a destructive nature.</p>

                <h2>Products and Pricing</h2>
                <p>All products are subject to availability. We reserve the right to discontinue any product at any time. Prices for our products are subject to change without notice.</p>

                <h2>Payment Terms</h2>
                <p>Payment is processed securely through Razorpay. By placing an order, you agree to pay the listed price plus applicable taxes and shipping charges.</p>

                <h2>Termination</h2>
                <p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>

                <h2>Disclaimer</h2>
                <p>The materials on Aadees are provided on an \'as is\' basis. Aadees makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>

                <h2>Limitations</h2>
                <p>In no event shall Aadees or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on Aadees, even if Aadees or a Aadees authorized representative has been notified orally or in writing of the possibility of such damage.</p>

                <h2>Revisions</h2>
                <p>The materials appearing on Aadees could include technical, typographical, or photographic errors. Aadees does not warrant that any of the materials on its website are accurate, complete, or current. Aadees may make changes to the materials contained on its website at any time without notice.</p>
            ',

            'privacy_policy_content' => '
                <h1>Privacy Policy</h1>

                <p><strong>Last updated:</strong> ' . date('F j, Y') . '</p>

                <h2>Information We Collect</h2>
                <p>We collect information you provide directly to us, such as when you create an account, make a purchase, or contact us for support. This may include:</p>
                <ul>
                    <li>Name, email address, and contact information</li>
                    <li>Billing and shipping addresses</li>
                    <li>Payment information (processed securely by Razorpay)</li>
                    <li>Order history and preferences</li>
                </ul>

                <h2>How We Use Your Information</h2>
                <p>We use the information we collect to:</p>
                <ul>
                    <li>Process and fulfill your orders</li>
                    <li>Provide customer support</li>
                    <li>Send you important updates about your orders</li>
                    <li>Improve our products and services</li>
                    <li>Send marketing communications (with your consent)</li>
                    <li>Comply with legal obligations</li>
                </ul>

                <h2>Information Sharing</h2>
                <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy:</p>
                <ul>
                    <li><strong>Service Providers:</strong> We may share information with trusted third parties who assist us in operating our website, conducting our business, or servicing you</li>
                    <li><strong>Legal Requirements:</strong> We may disclose information if required by law or to protect our rights and safety</li>
                    <li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of assets, your information may be transferred</li>
                </ul>

                <h2>Data Security</h2>
                <p>We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. Payment information is processed securely through Razorpay and is not stored on our servers.</p>

                <h2>Cookies and Tracking</h2>
                <p>We use cookies and similar technologies to enhance your browsing experience, analyze site traffic, and personalize content. You can control cookie settings through your browser preferences.</p>

                <h2>Your Rights</h2>
                <p>You have the right to:</p>
                <ul>
                    <li>Access the personal information we hold about you</li>
                    <li>Correct inaccurate or incomplete information</li>
                    <li>Request deletion of your personal information</li>
                    <li>Object to or restrict processing of your information</li>
                    <li>Data portability</li>
                </ul>

                <h2>Children\'s Privacy</h2>
                <p>Our service is not intended for children under 13. We do not knowingly collect personal information from children under 13. If we become aware that we have collected personal information from a child under 13, we will take steps to delete such information.</p>

                <h2>Changes to This Policy</h2>
                <p>We may update this privacy policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last updated" date.</p>

                <h2>Contact Us</h2>
                <p>If you have any questions about this Privacy Policy, please contact us at privacy@aadees.com or through our contact form.</p>
            ',
        ];

        foreach ($pageContents as $key => $content) {
            Setting::updateOrCreate(['key' => $key], ['value' => $content]);
        }
    }
}