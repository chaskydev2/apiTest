import React from "react";
import { Link } from "react-router";
import BrandLogoUrl from "@/assets/images/LOGO GUD.svg?url";

export default function AuthLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <div className="relative p-6 bg-white z-1 dark:bg-gray-900 sm:p-0">
      <div className="relative flex flex-col justify-center w-full h-screen lg:flex-row dark:bg-gray-900 sm:p-0">
        {children}
        <div className="items-center hidden w-full h-full lg:w-1/2 bg-[#F5D238] lg:grid relative overflow-hidden">
          {/* subtle depth gradient on the right side */}
          <div className="pointer-events-none absolute inset-y-0 right-0 w-1/2 bg-gradient-to-l from-[#eac62d] to-transparent opacity-40" aria-hidden="true"></div>
          
          {/* Faceted polygon shards along the divider (enhanced for innovative look) */}
          <div className="pointer-events-none absolute left-0 top-0 h-full w-52 -translate-x-1/2 hidden lg:block" aria-hidden="true">
          
          </div>
          <div className="relative flex items-center justify-center z-1">
            {/* Radial glow behind the logo */}
            <div className="pointer-events-none absolute inset-0 flex items-center justify-center">
              <div className="w-60 h-60 md:w-72 md:h-72 rounded-full bg-white/20 blur-3xl"></div>
            </div>

            <div className="relative z-10 flex flex-col items-center">
              <Link to="/" className="block">
                <img
                  width={231}
                  height={48}
                  src={BrandLogoUrl}
                  alt="Brand Logo"
                  className="h-24 md:h-28 lg:h-32 w-auto drop-shadow-lg"
                />
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}